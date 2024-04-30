<?php

/**
 * [v.1.0]
 * getTile Function => Get Page Title From $pageTitle Variable
 * If $pageTitle Is Set Echo $pageTitle
 * Else Echo Default Title
 */

function getTitle()
{
  global $pageTitle;
  if (isset($pageTitle)) {
    echo $pageTitle;
  } else {
    echo 'Admin';
  }
}

/**
 * [v.1.0]
 * checkItem Function => Check If Item Exists In Database
 * Return Count Of The Item If Exists
 * Return 0 If Not Exists
 * $column = The Column You Want To Select
 * $table = The Table You Want To Select From
 * $value = The Value You Want To Select
 * Example: checkItem('user_name', 'users', 'Ahmed')
 */

function checkItem($column, $table, $value)
{
  global $connect;
  $stmt = $connect->prepare("SELECT $column FROM $table WHERE $column = ?");
  $stmt->execute(array($value));

  return $stmt->rowCount();
}

/**
 * [v.2.0]
 * redirectFuncError => Make Redirect To Specific Page With Error Message
 * $msg = Echo The Message
 * $url = The Link You Want To Redirect To
 * $seconds = Seconds Before Redirecting
 */

function redirectFuncError($msg, $url = 'dashboard.php', $seconds = 3)
{
  $basename = basename($url, '.php');

  // Check If The Link Is Back
  if ($url == 'back'):

    // Check If The Previous Page Is Set
    if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])):
      $url = $_SERVER['HTTP_REFERER'];
      $frindlyUrl = 'Previous Page';

      // If Previous Page Is Not Set Redirect To Dashboard
    else:
      $url = 'dashboard.php';
      $frindlyUrl = 'Dashboard';
    endif;

    // Redirect To Specific Page If The Link Is Not Back
  else:
    $frindlyUrl = ucfirst($basename);
  endif;
  echo "<div class='container'>";
  echo "<div class='alert alert-danger'>$msg</div>";
  echo "<div class='alert alert-info'>You Will Be Redirected To $frindlyUrl Page After $seconds Seconds.</div>";
  echo "</div>";
  header("refresh:$seconds;url=$url");
  exit();
}

/**
 * [v.2.0]
 * redirectFuncSuccess => Make Redirect To Specific Page With Success Message 
 * $msg = Echo The Message
 * $url = The Link You Want To Redirect To
 * $seconds = Seconds Before Redirecting
 */

function redirectFuncSuccess($msg, $url = 'dashboard.php', $seconds = 3)
{
  $basename = basename($url, '.php');

  // Check If The Link Is Back
  if ($url == 'back'):

    // Check If The Previous Page Is Set
    if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])):
      $url = $_SERVER['HTTP_REFERER'];
      $frindlyUrl = 'Previous Page';

      // If Previous Page Is Not Set Redirect To Dashboard
    else:
      $url = 'dashboard.php';
      $frindlyUrl = 'Dashboard';
    endif;

    // Redirect To Specific Page If The Link Is Not Back
  else:
    $frindlyUrl = ucfirst($basename);
  endif;
  echo "<div class='container'>";
  echo "<div class='alert alert-success'>$msg</div>";
  echo "<div class='alert alert-info'>You Will Be Redirected To $frindlyUrl Page After $seconds Seconds.</div>";
  echo "</div>";
  header("refresh:$seconds;url=$url");
  exit();
}

/**
 * [v.2.0]
 * countItem Function => Count Number Of Items In Database
 * Return Count Of The Item
 * $item = The Item You Want To Count
 * $table = The Table You Want To Count From
 * Example: countItem('user_id', 'users')
 */

function countItem($item, $table, $val = 'all')
{
  global $connect;

  // Check If $val == 'all'
  if ($val == 'all'):
    $stmt = $connect->prepare("SELECT COUNT($item) FROM $table");
    $stmt->execute();
  else:
    $stmt = $connect->prepare("SELECT COUNT($item) FROM $table WHERE $item = ?");
    $stmt->execute(array($val));
  endif;
  return $stmt->fetchColumn();
}

/**
 * [v.1.0]
 * getUsername Function => Get Username From Database
 * Return Username
 * $id = The ID You Want To Get The Username
 * Example: getUsername($id)
 */

function getUsername($id)
{
  global $connect;
  $stmt = $connect->prepare("SELECT user_name FROM users WHERE user_id = ?");
  $stmt->execute(array($id));
  return $stmt->fetchColumn();
}