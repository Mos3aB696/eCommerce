<?php

session_start(); // Start The Session

session_unset(); // Unset The Data

// Check If there are Cookies
if (ini_get("session.use_cookies")):
  $params = session_get_cookie_params(); // Get The Session Cookie Parameters
  // Set The Cookie Parameters To The Past Time
  setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
endif;

session_destroy(); // Destroy The Session

header('Location: index.php'); // Redirect To Login Page

exit(); // Exit The Page To Prevent Loading The Rest Of The Code