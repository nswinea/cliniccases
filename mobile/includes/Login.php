<?php

session_start();
require('../../db.php');
require('../../lib/php/auth/pbkdf2.php');


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
    $response = array('error' => true,'message' => 'Sorry, there was a database error.' );
    echo json_encode($response);die;
}

if ($q->rowCount() < 1) {
    $response = array('error' => true,'message' => 'Sorry, your username and password
    were not recognized' );
    echo json_encode($response);die;
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
$_SESSION['is_logged_in'] = TRUE; 

//include '../html/templates/home.php';
$response = array('error' => false, 'message' => 'Logging you in');
echo json_encode($response);
