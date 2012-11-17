<?php
session_start();
require('../_CONFIG.php');
require('templates/header.php');

if (!isset($_SESSION['logged_in']))
{
    include 'templates/login.php';
}

include 'templates/footer.php';
