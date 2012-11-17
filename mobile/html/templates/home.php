<?php
include '../lib/php/auth/session_check.php';
?>

<div data-role="page" id="activity">

    <div data-role="header" data-theme="b">
        <h1><img src="../html/images/logo_sm.png"></h1>

        <div data-role="navbar">
            <ul>
                <li><a href="index.php?i=home" class="ui-btn-active ui-state-persist">Activity</a></li>
                <li><a href="index.php?i=cases">Cases</a></li>
                <li><a href="#quick_add">Quick Add</a></li>
                <li><a href="#logout">Logout</a></li>
            </ul>
        </div><!-- /navbar -->
            
    </div>

    <div data-role="content">   
        Welcome Aboard, <?php echo $_SESSION['first_name'];?>!
    </div>
</div>

<div data-role="page" id="cases">


    <div data-role="header" data-theme="b">
        <h1><img src="../html/images/logo_sm.png"></h1>

        <div data-role="navbar">
            <ul>
                <li><a href="index.php?i=home" class="ui-btn-active ui-state-persist">Activity</a></li>
                <li><a href="index.php?i=cases">Cases</a></li>
                <li><a href="#quick_add">Quick Add</a></li>
                <li><a href="#logout">Logout</a></li>
            </ul>
        </div><!-- /navbar -->
            
    </div>

   <div data-role="content">   
        <?php include 'cases.php'; ?> 
    </div>
</div>

<div data-role="page" id="quick_add">

    <div data-role="header" data-theme="b">
        <h1><img src="../html/images/logo_sm.png"></h1>

        <div data-role="navbar">
            <ul>
                <li><a href="index.php?i=home" class="ui-btn-active ui-state-persist">Activity</a></li>
                <li><a href="index.php?i=cases">Cases</a></li>
                <li><a href="#quick_add" class="ui-btn-active ui-state-persist">Quick Add</a></li>
                <li><a href="#logout">Logout</a></li>
            </ul>
        </div><!-- /navbar -->

 

    <div data-role="content">   
        Quick Add goes here.
    </div>
</div>

