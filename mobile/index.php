<?php
session_start();
require('../_CONFIG.php');
require('html/templates/header.php');
require('html/templates/panel.php');
require('includes/load.php');

if (!isset($_SESSION['cc_mobile_id']))
{
    $page = load('login');
}
else
{
    if (isset($_GET['i']))
    {
        $page = load($_GET['i']);
    }
    else
    {
        $page = load('home');
    }

}

include($page);

include 'html/templates/footer.php';
