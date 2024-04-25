<?php
session_start();
// Check If The User Is Logged In
if (isset($_SESSION['user_name'])):
  $pageTitle = 'Dashboard';
  // Include Required Files
  include ('init.php');

  include $temp . ('footer.php');

else:
  // include ('includes/languages/english.php');
  // // include ('includes/languages/arabic.php');
  // // Redirect To Login Page If The User Is Not Admin.
  // echo "<div
  // style='text-align: center; margin: 100px auto; font-size: 20px;
  // font-weight:bold ; color: #fff; background: #008dde;
  // width:fit-content; padding:15px 30px; border-radius: 15px;'>";
  // echo lang("DASHBOARD_DIRECT_WARNING");
  // echo "</div>";
  // // echo '<meta http-equiv="refresh" content="3;url=index.php">';
  // header('refresh:3;url=index.php');
  header('Location: index.php');
  exit();
endif;