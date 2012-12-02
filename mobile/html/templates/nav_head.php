
    <div data-role="header" data-position="fixed" data-theme="b" data-id="m_head">
        <div class="ui-bar"><img src="../html/images/logo_small4.png"></div>
        <div class="ui-bar ui-btn-right">
            <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?> &nbsp
            <img src='<?php echo generate_avatar($dbh,$_SESSION['login'],true);?>'>
        </div>
        <div data-role="navbar">
            <ul>
                <li><a href="index.php?i=home" data-index="0">Home</a></li>
                <li><a href="index.php?i=cases" data-index="1">Cases</a></li>
                <li><a href="index.php?i=messages" data-index="2">Messages</a></li>
                <li><a href="index.php?i=board" data-index="3">Board</a></li>
                <?php if ($_SESSION['permissions']['reads_journals'] == '1' ||
                $_SESSION['permissions']['writes_journals'] == '1'){ ?>
                <li><a href="index.php?i=journals" data-index="4">Journals</a></li>
                <?php } ?>
            </ul>
        </div><!-- /navbar -->
            
    </div>
