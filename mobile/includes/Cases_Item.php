<?php
require('includes/session_check.php');
require('../db.php');
include('includes/generate_avatar.php');
include('../lib/php/utilities/convert_case_time.php');
include('../lib/php/utilities/convert_times.php');
include('../lib/php/utilities/names.php');

$id = $_GET['id'];
$type = $_GET['type'];

switch ($type) {
    case 'sections':
        $q = $dbh->prepare("SELECT * FROM cm WHERE id = ? ");
        $q->bindParam(1,$id);
        $q->execute();
        $items = $q->fetch(PDO::FETCH_OBJ);
        break;
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
        $q = $dbh->prepare("SELECT * FROM cm_documents WHERE `case_id` = ? ORDER BY `extension` asc");
        $q->bindParam(1,$id);
        $q->execute();
        $items = $q->fetchAll(PDO::FETCH_OBJ);
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
