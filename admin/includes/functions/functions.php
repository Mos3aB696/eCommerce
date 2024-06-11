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
 * [v.1.0]
 * editCheck Function => Check If Item Exists In Database Except The Current One
 * Return Count Of The Item If Exists
 * Return 0 If Not Exists
 * $column = The Column You Want To Select
 * $table = The Table You Want To Select From
 * $value = The Value You Want To Select
 * $idName = The ID Column Name
 * $id = The ID You Want To Exclude
 * Example: editCheck('user_name', 'users', 'Ahmed', 'user_id', 1)
 */
function editCheck($column, $table, $value, $idName, $id)
{
  global $connect;
  $stmt = $connect->prepare("SELECT $column FROM $table WHERE $column = ? AND $idName != ?");
  $stmt->execute(array($value, $id));

  return $stmt->rowCount();
}

/**
 * [v.3.0]
 * redirectFuncError => Make Redirect To Specific Page With Error/s Message/s
 * $error = Echo The Error Message
 * $url = The Link You Want To Redirect To
 * $seconds = Seconds Before Redirecting
 */

function redirectFuncError($error, $url = 'dashboard.php', $seconds = 3)
{
  // Set Array Of Errors
  global $formErrors;
  // Check If $error Is Array, If Not => Convert It To An Array
  if (!is_array($error)):
    $error = array($error);
  endif;
  $formErrors = $error; // Store All Errors In formErrors Array

  $basename = basename($url, '.php'); // 'members.php' => 'members'

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

  echo "<div class='container mt-5'>";
  // Make Loop On All Errors [1]
  foreach ($formErrors as $err):
    echo "<div class='alert alert-danger'>$err</div>";
  endforeach;
  // Display The Redirection Time [2]
  echo "<div class='alert alert-info'>You Will Be Redirected To $frindlyUrl Page After $seconds Seconds.</div>";
  echo "</div>";
  // Redirect After Display All Messages [3]
  header("refresh:$seconds;url=$url");
  exit();
}

/**
 * [v.3.0]
 * redirectFuncSuccess => Make Redirect To Specific Page With Success Message 
 * $msg = Echo The Message
 * $url = The Link You Want To Redirect To
 * $seconds = Seconds Before Redirecting
 */

function redirectFuncSuccess($msg, $url = 'dashboard.php', $seconds = 3)
{
  global $successMsg;

  if (!is_array($msg)):
    $msg = array($msg);
  endif;

  $successMsg = $msg;

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
  foreach ($successMsg as $msg):
    echo "<div class='alert alert-success'>$msg</div>";
  endforeach;
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
 * [v.2.0]
 * getName Function => Get Column Name From Database
 * Return Name From Database
 * $column = The Column You Want To Select
 * $table = The Table You Want To Select From
 * $colId = The Column ID You Want To Select
 * $id = The ID You Want To Get The Username
 * Example: getName('user_name', 'users', 'user_id', 1)
 */

function getName($column, $table, $colId, $id)
{
  global $connect;
  $stmt = $connect->prepare("SELECT $column FROM $table WHERE $colId = ?");
  $stmt->execute(array($id));
  return $stmt->fetchColumn();
}

/**
 * [v.1.0]
 * getNameByCommentId Function => Get Username By Comment ID
 * Return Username
 * $commentid = The Comment ID You Want To Get The Username
 * Example: getNameByCommentId(1)
 */

function getNameByCommentId($commentid)
{
  global $connect;
  $stmt = $connect->prepare('SELECT
                                users.user_name
                              FROM
                                users
                              INNER JOIN
                                comments
                              ON 
                                comments.user_connect = users.user_id
                              WHERE
                                comment_id = ?');

  $stmt->execute([$commentid]);
  return $stmt->fetchColumn();
}

/**
 * [v.1.0]
 * getLatest Function => Get Latest Items From Database
 * Return Latest Items
 * $column = The Column You Want To Select
 * $table = The Table You Want To Select From
 * $order = The Column You Want To Order By
 * $limit = Number Of Items You Want To Get
 * Example: getLatest('user_name', 'users', 'user_id', 5)
 */

function getLatest($column, $table, $order, $limit = 5)
{
  global $connect;
  $stmt = $connect->prepare("SELECT $column FROM $table ORDER BY $order DESC LIMIT $limit");
  $stmt->execute();
  return $stmt->fetchAll();
}

/**
 * [v.1.0]
 * findMissingKeysInArabic Function => Find Missing Keys In Arabic Array
 * Return Missing Keys
 * $englishArray = English Array
 * $arabicArray = Arabic Array
 * Example: findMissingKeysInArabic($englishArray, $arabicArray)
 * Note: This Function Is Used To Find Missing Keys In Arabic Array
 * 
 */
function findMissingKeysInArabic($englishArray, $arabicArray)
{
  $missingKeys = [];

  foreach ($englishArray as $key => $value) {
    if (!array_key_exists($key, $arabicArray)) {
      $missingKeys[] = $key;
    }
  }

  return $missingKeys;
}