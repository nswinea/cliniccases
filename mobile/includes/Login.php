<?php
session_start();
require('../../db.php');
require('../../lib/php/auth/pbkdf2.php');

//define variables
$user = $_POST['username'];
$salt = CC_SALT;
$hash = pbkdf2($_POST['password'], $salt, 1000, 32);
$password = base64_encode($hash);
$remember = $_POST['remember'];

//auto-login
if (isset($_POST['auto'])) {
   //Determine the correct hash
    $q = $dbh->prepare('SELECT * FROM cm_users WHERE username = ?');
    $q->bindParam(1,$user);
    $q->execute();
    $v = $q->fetch(PDO::FETCH_OBJ);
    $hash_should_be = md5($v->id + $v->username + $salt);
    if ($hash_should_be !== $_POST['auto'])
    {
        $response = array('error' => true,'message' => 'There was an error logging you in');
        echo json_encode($response);die;
    }

} else {
    $q = $dbh->prepare("SELECT * from cm_users WHERE 
    username = ? AND password = ?");
    $q->bindParam(1,$user);
    $q->bindParam(2,$password);
    $q->execute();
    $v = $q->fetch(PDO::FETCH_OBJ);
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
}


//Generate hash if "remember me" is checked
if ($remember == 'on')
{
    $auto_hash = md5($v->id + $v->username + $salt);
}

//Determine the user's group and put the relevant permissions in an array
$group_query = $dbh->prepare("SELECT * FROM cm_groups WHERE group_name = ? LIMIT 1");
$group_query->bindParam(1, $v->grp);
$group_query->execute();
$permissions = $group_query->fetch(PDO::FETCH_ASSOC);

//Create Session Variables
$_SESSION['permissions'] = $permissions;
$_SESSION['login'] = $v->username;
$_SESSION['group'] = $v->grp;
$_SESSION['first_name'] = $v->first_name;
$_SESSION['last_name'] = $v->last_name;
$_SESSION['email'] = $v->email;
$_SESSION['timezone_offset'] = $v->timezone_offset;
$_SESSION['picture_url'] = $v->picture_url;
$_SESSION['private_key'] = $v->private_key;

//Create a unique session id and then write to the log
$sess_id = md5(time());
$_SESSION['cc_mobile_id'] = $sess_id;
//$_SESSION['is_logged_in'] = TRUE; 

if ($remember == 'on')
{
    $response = array('error' => false, 'message' => 'Logging you in',
    'username' => $user,'hash' => $auto_hash);
}
else
{
    $response = array('error' => false, 'message' => 'Logging you in',
    'username' => false,'hash' => false);
}

echo json_encode($response);
