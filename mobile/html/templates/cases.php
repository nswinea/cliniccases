<?php 
require('includes/session_check.php');
require('includes/Cases.php');
include('includes/generate_avatar.php');
?>

<div data-role="page" id="cases" data-title="Cases">

    <?php require_once('nav_head.php'); ?>

    <div data-role="content">
        <ul data-role="listview" data-filter="true">

        <?php foreach ($cases as $c) {extract($c); 

        echo "<li>" . $c['last_name'] . ", " . $c['first_name'] ."</li>";
        }?>

        </ul>
    </div>

    <?php require_once('nav_foot.php'); ?>

</div>
