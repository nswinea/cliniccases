<?php
require('includes/session_check.php');
require('../db.php');
include('includes/generate_avatar.php');

$id = $_GET['id'];
$type = $_GET['type'];
//$id = '1175';
//$type = 'case_notes';
switch ($type) {
    case 'case_notes':
        $q = $dbh->prepare("SELECT * FROM cm_case_notes WHERE `case_id` = ? ORDER BY `date` DESC");
        $q->bindParam(1,$id);
        $q->execute();
        $items = $q->fetchAll(PDO::FETCH_OBJ);
        break;
    case 'case_data':
        // code...
        break;
    case 'case_docs':
        // code...
        break;
    case 'case_events':
        // code...
        break;
    case 'case_contacts':
        // code...
        break;
    default:
        die('Not authorized');
        break;
}
