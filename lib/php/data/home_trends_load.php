<?php
session_start();
require('../auth/session_check.php');
require('../../../db.php');

//What kind of charts?
// 1. view all cases - see most active groups, users, cases
// 2. supervises - see most active users, cases
// 3. is supervised - see most active users in their group, most active cases
//All of these are over a user-selected time period


include('../../../html/templates/interior/home_trends.php');
