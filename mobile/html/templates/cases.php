<?php 
require('includes/session_check.php');
require('includes/Cases.php');
include('includes/generate_avatar.php');
?>

<div data-role="page" id="cases" data-title="Cases">

    <?php require_once('nav_head.php'); ?>

    <div data-role="content">
        <?php if (!empty($cases)){ ?>
            <!-- <div data-role="controlgroup" data-type="horizontal" class="home_sub_nav">
                <a href="index.html" data-role="button" data-mini="true" class="ui-btn-active">Open</a>
                <a href="index.html" data-role="button" data-mini="true">Closed</a>
                <a href="index.html" data-role="button" data-mini="true">All</a>
                <a href="index.html" data-role="button" data-mini="true">Recent</a>
                </div>-->
        <div data-role="fieldcontain">
            <input type="search" name="search" data-id="search-basic" class="inf_search inf_search_sm" value="" />
            <select>
                <option>Open</option>
                <option>Closed</option>
            </select>
        </div>
        <div class="inf_contain">
            <ul data-role="listview" data-filter="false" class="infinite">

            <?php 
            if (!empty($cases)){
                foreach ($cases as $c) {extract($c); 

                echo "<li><a href='index.php?i=cases_item&type=sections&id=" . $c['id'] .
                "'>" . $c['last_name'] . ", " . $c['first_name'] ."</a></li>";
            }}?>
            </ul>
            <div class="navigation">
                <a href="index.php?i=cases<?php 
                    if (isset($_GET['start']))
                    {echo "&start=" . ($_GET['start'] + 20);} 
                    else{echo "&start=20";}

                    if (isset($_GET['search']))
                    {
                        echo "&search=" . $_GET['search'];
                    }
                    
                    ?>">Next</a>
            </div>
            
        </div>
        <?php } else { ?>

            <div><h3>No cases found.</h3></div>
            <?php } ?> 
    </div>

    <?php require_once('nav_foot.php'); ?>

</div>
