<?php 
require('includes/session_check.php');
require('includes/Cases.php');
include('includes/generate_avatar.php');
?>

<div data-role="page" id="cases" data-title="Cases">

    <?php require_once('nav_head.php'); ?>

    <div data-role="content">
        <?php if (!empty($cases)){ ?>
        <div data-role="controlgroup" data-type="horizontal" class="home_sub_nav case-status-chooser">
            <a href="index.php?i=cases&status=open" data-role="button" data-mini="true" class="status-open">Open</a>
            <a href="index.php?i=cases&status=closed" data-role="button" data-mini="true" class="status-closed">Closed</a>
            <a href="index.php?i=cases&status=all" data-role="button" data-mini="true" class="status-all">All</a>
        </div>
        <div data-role="fieldcontain">
            <input type="search" name="search" data-id="search-basic" class="inf_search inf_search_sm" value="" />
        </div>
        <div class="inf_contain">
            <ul data-role="listview" data-filter="false" class="infinite">

            <?php 
            if (!empty($cases)){
                foreach ($cases as $c) {extract($c); 
                    if ($c['organization']){
                        echo "<li><a href='index.php?i=cases_item&type=sections&id=" . $c['id'] .
                        "'>" . $c['organization'] ."</a></li>";
                    } else {
                        echo "<li><a href='index.php?i=cases_item&type=sections&id=" . $c['id'] .
                        "'>" . $c['last_name'] . ", " . $c['first_name'] ."</a></li>";
                    }
            }}?>
            </ul>
            <div class="navigation">
                <?php 
                    $nav_string = "index.php?i=cases&status=$status&start=$start";
                    if ($search) {
                        $nav_string .= "&search=$search";
                    }
                ?>
                <a href="<?php echo $nav_string; ?>">Next</a>
            </div>
            
        </div>
        <?php } else { ?>

            <div><h3>No cases found.</h3></div>
            <?php } ?> 
    </div>

    <?php require_once('nav_foot.php'); ?>

</div>
