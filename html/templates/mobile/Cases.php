<?php 
include 'html/templates/interior/idletimeout.php'; 
include 'lib/php/data/cases_load.php';
?>
</head>
<body class="isMobile">
<div class="navbar navbar-fixed-top navbar-headnav">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar btn-push-down" data-toggle="collapse" data-target=".nav-collapse">
                Menu
                <i class="icon-chevron-down icon-white"></i>
            </a>
            <a class="btn btn-navbar btn-push-down" href="index.php?i=QuickAdd.php">
                Quick Add
                <i class="icon-plus icon-white"></i>
            </a>
            <a class="brand" href="#"><img src="html/images/logo_sm.png"></a>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li ><a href="index.php?i=Home.php">Home</a></li>
                    <li class="active"><a href="index.php?i=Cases.php">Cases</a></li>
                    <li><a href="index.php?i=Messages.php">Messages</a>
                    <?php if ($_SESSION['permissions']['view_board'] === '1'){ ?>
                    <li><a href="index.php?i=Board.php">Board</a>
                    <?php } ?>
                    <li><a href="index.php?i=QuickAdd.php">Quick Add</a>
                    <li><a href="index.php?i=Logout.php&user=1">Logout</a>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div>


<div class="container">
    <div class="row" id="notifications"></div>
    <div class="row">
        <h1>Cases</h1>
    </div>
    <div class="row">
        <form class="navbar-search pull-left">
            <input type="text" class="case-search search-query" placeholder="Search">
            <select name="case-status" class="inline small-select search-query">
                <option value="open">Open</option>
                <option value="closed">Closed</option>
            </select>
        </form>
    </div>
    <div class="row">
    <?php if (empty($raw_results)) {
        echo "<p class='end'>No cases found</p>";
        } else {
            echo "<ul class=\"nav nav-pills nav-stacked\">";
                foreach ($raw_results as $r) {extract($r);
                    if ($date_close !== ''){
                        echo "<li class='table-case-item table-case-closed'>";
                    } else {
                        echo "<li class='table-case-item table-case-open'>";
                    }
                    echo "<a href='index.php?i=Case.php&id=$id'>" .  case_id_to_casename($dbh,$id) . 
                    "<i class=\"pull-right icon-chevron-right\"></i></a></li>";
                }
            echo "</ul>";
        }
    ?>
    </div>
</div>
</body>
</html>
