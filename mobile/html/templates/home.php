<?php
require('includes/session_check.php');
include('includes/generate_avatar.php');
?>

<div data-role="page" id="activity">

    <div data-role="header" data-theme="b">
        <div class="ui-bar"><img src="../html/images/logo_small4.png"></div>
        <a href="#" class="ui-btn-right ui-btn ui-shadow ui-btn-corner-all ui-btn-icon-left ui-btn-up-b"> 
            <span class="ui-btn-inner ui-btn-corner-all">
                <span class="ui-btn-text"><img src='../people/tn_1.jpg'></span>
                <span class="ui-icon ui-icon-gear ">&nbsp;</span>
            </span>
        </a>
        <div data-role="navbar">
            <ul>
                <li><a href="index.php?i=home" class="ui-btn-active ui-state-persist">Activity</a></li>
                <li><a href="index.php?i=cases">Cases</a></li>
                <li><a href="#quick_add">Quick Add</a></li>
                <li><a href="index.php?i=logout">Logout</a></li>
            </ul>
        </div><!-- /navbar -->
            
    </div>

    <div data-role="content">   
        Welcome Aboard, <?php echo $_SESSION['first_name'];?>!
    </div>
</div>


