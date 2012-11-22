<?php 
require('includes/session_check.php');
require('includes/Cases.php');
include('includes/generate_avatar.php');
?>

<div data-role="page" id="cases">

    <div data-role="header" data-theme="b" data-position="fixed">
        <div class="ui-bar"><img src="../html/images/logo_small4.png"></div>
        <a href="#" class="ui-btn-right ui-btn ui-shadow ui-btn-corner-all ui-btn-icon-left ui-btn-up-b"> 
            <span class="ui-btn-inner ui-btn-corner-all">
                <span class="ui-btn-text">
                    <img src='<?php echo generate_avatar($dbh,$_SESSION['login']);?>'>
                </span>
                <span class="ui-icon ui-icon-gear ">&nbsp;</span>
            </span>
        </a>
        <div data-role="navbar">
            <ul>
                <li><a href="index.php?i=home">Activity</a></li>
                <li><a href="index.php?i=cases" class="ui-btn-active ui-state-persist">Cases</a></li>
                <li><a href="#quick_add">Quick Add</a></li>
                <li><a href="#logout">Logout</a></li>
            </ul>
        </div><!-- /navbar -->
            
    </div>

    <div data-role="content">
        <ul data-role="listview" data-filter="true">

        <?php foreach ($cases as $c) {extract($c); 

        echo "<li>" . $c['last_name'] . ", " . $c['first_name'] ."</li>";
        }?>

        </ul>
    </div>
</div>
