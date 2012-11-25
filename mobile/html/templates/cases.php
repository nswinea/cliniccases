<?php 
require('includes/session_check.php');
require('includes/Cases.php');
include('includes/generate_avatar.php');
?>

<div data-role="page" id="cases" data-title="Cases">

    <?php require_once('nav_head.php'); ?>

    <div data-role="content">
        <div data-role="fieldcontain">
            <label for="search-basic">Search:</label>
            <input type="search" name="search" id="search-basic" class="inf_search" value="" />
        </div>
        <ul data-role="listview" data-filter="false" class="infinite">

        <?php foreach ($cases as $c) {extract($c); 

        echo "<li><a href='index.php?i=cases_item&type=sections&id=" . $c['id'] . "'>" . $c['last_name'] . ", " . $c['first_name'] ."</a></li>";
        }?>

        </ul>
    </div>

    <div class="navigation">
        <a href="index.php?i=cases&start=<?php if (isset($_GET['start'])){echo $_GET['start'] + 20;} else{echo "20";}?>">Next</a>
    </div>

    <?php require_once('nav_foot.php'); ?>

</div>
