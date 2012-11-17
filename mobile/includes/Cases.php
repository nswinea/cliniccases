<?php
require('../db.php');

$user = $_SESSION['login'];

if ($_SESSION['permissions']['view_all_cases'] == "0")
{
    $sql = "SELECT cm.*, cm_case_assignees.case_id,
    cm_case_assignees.username FROM cm, cm_case_assignees
    WHERE cm.id = cm_case_assignees.case_id AND
    cm_case_assignees.username =  :username AND
    cm_case_assignees.status =  'active'";

}
elseif ($_SESSION['permissions']['view_all_cases'] == "1")
{
    //admin or super user type query - Users who can access all cases and "work" on all cases.
    $sql = "SELECT * FROM cm";
}
else
{
    die('error');
}


$q = $dbh->prepare($sql);
$q->bindParam(':username',$user);
$q->execute();
$error = $q->errorInfo();
$cases = $q->fetchAll(PDO::FETCH_ASSOC);
