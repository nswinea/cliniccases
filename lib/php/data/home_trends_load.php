<?php
session_start();
require('../auth/session_check.php');
require('../../../db.php');
require('../users/user_data.php');

$user = $_SESSION['login'];

//What kind of charts?
// 1. view all cases - see most active groups, users, cases
// 2. supervises - see most active users, cases
// 3. is supervised - see most active users in their group, most active cases
//All of these are over a user-selected time period

if ($_SESSION['permissions']['supervises'] == '1')
{
	$q = all_users_by_supvsr($dbh,$user);

	//print_r($q);
}

include('../../../html/templates/interior/home_trends.php');
