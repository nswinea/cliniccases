<?php
require('includes/session_check.php');
require('includes/Home.php');
?>

<div data-role="page" id="activity" data-title="Activity">

    <div data-role="header" data-position="fixed" data-theme="b">
        <div class="ui-bar"><img src="../html/images/logo_small4.png"></div>
        <div class="ui-bar ui-btn-right">
            <img src='<?php echo generate_avatar($dbh,$_SESSION['login'],true);?>'>
        </div>
        <div data-role="navbar">
            <ul>
                <li><a href="index.php?i=home" class="ui-btn-active ui-state-persist">Activity</a></li>
                <li><a href="index.php?i=cases">Cases</a></li>
                <li><a href="index.php?i=messages">Messages</a></li>
                <li><a href="index.php?i=board">Board</a></li>
                <?php if ($_SESSION['permissions']['reads_journals'] == '1' ||
                $_SESSION['permissions']['writes_journals'] == '1'){ ?>
                <li><a href="index.php?i=journals">Journals</a></li>
                <?php } ?>
            </ul>
        </div><!-- /navbar -->
            
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
    <div data-role="footer" data-position="fixed" id="m_footer" data-theme="b">
        <div data-role="controlgroup" data-type="horizontal" >
            <a href="#" data-role="button" data-icon="plus" data-corners="true" data-shadow="true">
                Quick Add
            </a>
            <a href="#" data-role="button" data-icon="gear" data-corners="true" data-shadow="true">
                Settings
            </a>
        </div>
    </div>
</div>
