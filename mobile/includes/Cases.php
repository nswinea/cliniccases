<?php
require('../db.php');

$user = $_SESSION['login'];

if (isset($_GET['start']))
{
    $start = $_GET['start'] + 20;
}
else
{
    $start = '0';
}

if (isset($_GET['search']))
{
    $search = $_GET['search'];
}
else
{
    $search = false;
}

if (isset($_GET['status'])) 
{

    if ($_GET['status'] === 'open')
    {
        $status = 'open';
        $status_filter = "AND cm.date_close = ''";
    } 
    else if ($_GET['status'] === 'closed')
    {
        $status = 'closed';
        $status_filter = "AND cm.date_close != ''";
    }
    else if ($_GET['status'] === 'all')
    {
        $status = 'all';
        $status_filter = null;
    }

}
else
{
    $status = 'open';
    $status_filter = "AND cm.date_close = ''";
} 

if ($_SESSION['permissions']['view_all_cases'] == "0")
{
    if ($search)
    {
        $sql = "SELECT cm.*, cm_case_assignees.case_id,
        cm_case_assignees.username FROM cm, cm_case_assignees
        WHERE cm.id = cm_case_assignees.case_id AND
        cm_case_assignees.username =  :username AND
        cm_case_assignees.status =  'active' 
        AND (cm.first_name LIKE '%$search%' OR cm.last_name 
        LIKE '%$search%' OR cm.organization LIKE '%$search%')
        $status_filter ORDER BY cm.last_name ASC LIMIT $start,20";
    }
    else
    {
        $sql = "SELECT cm.*, cm_case_assignees.case_id,
        cm_case_assignees.username FROM cm, cm_case_assignees
        WHERE cm.id = cm_case_assignees.case_id AND
        cm_case_assignees.username =  :username AND
        cm_case_assignees.status =  'active' $status_filter ORDER BY cm.last_name ASC LIMIT $start,20";
    }

}
elseif ($_SESSION['permissions']['view_all_cases'] == "1")
{
    //admin or super user type query - Users who can access all cases and "work" on all cases.

    if ($search)
    {
        $sql = "SELECT * FROM cm WHERE (first_name LIKE '%$search%' OR
        last_name LIKE '%$search%' OR organization LIKE '%$search%') 
        $status_filter ORDER BY last_name ASC LIMIT $start, 20";
    }
    else
    {
        if ($_GET['status'] === 'closed') {
            $sql = "SELECT * FROM cm WHERE date_close != '' ORDER BY last_name ASC LIMIT $start, 20";
        } elseif ($_GET['status'] === 'open') {
            $sql = "SELECT * FROM cm WHERE date_close = '' ORDER BY last_name ASC LIMIT $start, 20";
        } else {
            $sql = "SELECT * FROM cm ORDER BY last_name ASC LIMIT $start, 20";
        }

    }
}
else
{
    die('Sorry, there was an error');
}


$q = $dbh->prepare($sql);
$q->bindParam(':username',$user);
$q->execute();
$error = $q->errorInfo();
$cases = $q->fetchAll(PDO::FETCH_ASSOC);
