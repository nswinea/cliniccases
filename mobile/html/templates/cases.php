<?php require('includes/Cases.php');?>

<div data-role="page" id="cases">

    <div data-role="header" data-theme="b">
        <h1><img src="../html/images/logo_sm.png"></h1>

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
