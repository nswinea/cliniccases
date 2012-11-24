<?php
require('includes/session_check.php');
require('includes/Home.php');
?>

<div data-role="page" id="activity" data-title="Activity">

    <?php require_once('nav_head.php'); ?>
    <div data-role="controlgroup" data-type="horizontal" data-position-"fixed" class="home_sub_nav">
        <a href="index.html" data-role="button" data-mini="true" class="ui-btn-active">Activity</a>
        <a href="index.html" data-role="button" data-mini="true">Upcoming</a>
        <a href="index.html" data-role="button" data-mini="true">Trends</a>
    </div>
    <div data-role="content">   
        <ul data-role="listview">
        <?php foreach($activities as $a){extract($a); ?>
            <li>
                <img src="<?php echo $thumb;?>">
                <h4><?php echo $by . " " . $action_text . " " . $casename;?></h4> 
                <p><?php echo $what; ?></p>
                <p><?php echo $time_formatted; ?></p> 
            </li>
        <?php } ?>
        </ul>
    </div>
    <?php require_once('nav_foot.php'); ?>
</div>
