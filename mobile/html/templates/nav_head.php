
    <div data-role="header" data-position="fixed" data-theme="b" id="m_head">
        <div class="ui-bar"><img src="../html/images/logo_small4.png"></div>
        <div class="ui-bar ui-btn-right">
            <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?> &nbsp
            <img src='<?php echo generate_avatar($dbh,$_SESSION['login'],true);?>'>
        </div>
        <div data-role="navbar">
            <ul>
                <li><a href="index.php?i=home" class="ui-btn-active">Activity</a></li>
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
