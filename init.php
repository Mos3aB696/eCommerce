<?php

/**
 * Init File Make Connection Between All Files
 * You Can Edit All Files From Here Only This Is Amazing!!!
 */

// Error Reporting
ini_set('display_errors', 'On');
error_reporting(E_ALL);

include "./admin/db_connect.php";

$sessionUser = '';
if (isset($_SESSION['user_name'])) :
  $sessionUser = $_SESSION['user_name'];
endif;

// Routes
$temp = 'includes/templates/'; // Template Directory
$lang = 'admin/includes/languages/'; // Languages Directory
$func = 'admin/includes/functions/'; // Functions Directory
$css = 'layout/css/'; // CSS Directory
$js = 'layout/js/'; // JS Directory

// Include The Important Files
include  "{$lang}english.php";
// include $lang . ('arabic.php');
include "{$func}functions.php";
include "{$temp}header.php";
