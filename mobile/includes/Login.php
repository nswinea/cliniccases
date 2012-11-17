<?php

session_start();
require('../../db.php');
include '../../lib/php/auth/pbkdf2.php';


$user = $_POST['username'];
$salt = CC_SALT;
$hash = pbkdf2($_POST['password'], $salt, 1000, 32);
$password = base64_encode($hash);

$q = $dbh->prepare("SELECT * from cm_users WHERE 
username = ? AND password = ?");

$q->bindParam(1,$user);
$q->bindParam(2,$password);
$q->execute();
$error = $q->errorInfo();

if ($error[1]) {
    print_r($error);die;
}

if ($q->rowCount() < 1) {
    include('../templates/login_fail.php');
    die;
}

$r = $q->fetch(PDO::FETCH_OBJ);

//Determine the user's group and put the relevant permissions in an array
$group_query = $dbh->prepare("SELECT * FROM cm_groups WHERE group_name = ? LIMIT 1");
$group_query->bindParam(1, $r->grp);
$group_query->execute();
$permissions = $group_query->fetch(PDO::FETCH_ASSOC);

//Create Session Variables
$_SESSION['permissions'] = $permissions;
$_SESSION['login'] = $r->username;
$_SESSION['group'] = $r->grp;
$_SESSION['first_name'] = $r->first_name;
$_SESSION['last_name'] = $r->last_name;
$_SESSION['email'] = $r->email;
$_SESSION['timezone_offset'] = $r->timezone_offset;
$_SESSION['picture_url'] = $r->picture_url;
$_SESSION['private_key'] = $r->private_key;

//Create a unique session id and then write to the log
$sess_id = md5(time());
$_SESSION['cc_session_id'] = $sess_id;

include '../templates/home.php';
