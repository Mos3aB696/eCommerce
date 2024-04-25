<?php

/**
 * Init File Make Connection Between All Files
 * You Can Edit All Files From Here Only This Is Amazing!!!
 */

include ('db_connect.php');

// Routes
$temp = 'includes/templates/'; // Template Directory
$lang = 'includes/languages/'; // Languages Directory
$func = 'includes/functions/'; // Functions Directory
$css = 'layout/css/'; // CSS Directory
$js = 'layout/js/'; // JS Directory

// Include The Important Files
include $lang . ('english.php');
// include $lang . ('arabic.php');
include $func . ('functions.php');
include $temp . ('header.php');

// Include Navbar On All Pages Dose Not Have $noNavBar Variable

if (!isset($noNavBar)):
  include $temp . ('navbar.php');
endif;