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
        <div class="inf_contain">
            <ul data-role="listview" data-filter="false" class="infinite">

            <?php foreach ($cases as $c) {extract($c); 

            echo "<li><a href='index.php?i=cases_item&type=sections&id=" . $c['id'] .
            "'>" . $c['last_name'] . ", " . $c['first_name'] ."</a></li>";
            }?>

            </ul>
            <div class="navigation">
                <a href="index.php?i=cases<?php 
                    if (isset($_GET['start']))
                    {echo "&start=" . $_GET['start'] + 20;} 
                    else{echo "&start=20";}

                    if (isset($_GET['search']))
                    {
                        echo "&search=" . $_GET['search'];
                    }
                    
                    
                    ?>">Next</a>
            </div>
        </div>
    </div>

    <?php require_once('nav_foot.php'); ?>

</div>
