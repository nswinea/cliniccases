
    <div data-role="header" data-position="fixed" data-theme="b" data-id="m_head" id="m_header">
        <a href="#m_panel" data-inline="true" data-iconpos="notext" data-role="button" data-icon="bars">Menu</a>
        <h1><img src="../html/images/logo_small4.png"></h1>
        <div class="ui-bar ui-btn-right">
            <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?> &nbsp
            <img src='<?php echo generate_avatar($dbh,$_SESSION['login'],true);?>'>
        </div>
        <div data-role="navbar">
            <ul>
                <li><a href="index.php?i=home" data-index="0">Home</a></li>
                <li><a href="index.php?i=cases" data-index="1">Cases</a></li>
                <li><a href="index.php?i=messages" data-index="2">Messages</a></li>
                <li><a href="index.php?i=journals" data-index="4">Quick Add</a></li>
            </ul>
        </div><!-- /navbar -->
            
    </div>
