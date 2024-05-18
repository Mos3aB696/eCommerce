<?php
session_start();
$noNavBar = '';
$pageTitle = 'login';
// Check If The User Is Logged In And Redirect To Dashboard Page Automatically

if (isset($_SESSION['user_name'])):
  header('Location: dashboard.php');
  exit();
endif;
include ('init.php');

// Check If The User Coming From HTTP Post Request
if ($_SERVER['REQUEST_METHOD'] == 'POST'):
  $username = $_POST['username'];
  $password = $_POST['password'];
  $hashedPass = sha1($password); // Encrypt The Password

  // Check If The User Exist In Database

  // Prepare The Statement To Execute It [1]
  $stmt = $connect->prepare('SELECT 
                                  user_id, user_name, pass
                              FROM
                                  users
                              WHERE
                                  user_name = ?
                              AND
                                  pass = ?
                              AND
                                  group_id = 1
                              LIMIT 1');
  $stmt->execute(array($username, $hashedPass)); // Execute The Statement [2]
  $row = $stmt->fetch(); // Fetch The Data [3]
  $rowCount = $stmt->rowCount(); // Get The Count Of The Rows [4]

  // If rowCount > 0 This Means group_id = 1 => The User Is Admin

  if ($rowCount > 0):
    $_SESSION['user_name'] = $username; // Register Session Name
    $_SESSION['user_id'] = $row['user_id']; // Register Session ID
    header('Location: dashboard.php'); // Redirect To Dashboard Page
    exit();
  endif;
endif;
?>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="login d-grid gap-2">
  <h3 class="text-center"><?= lang("ADMIN_LOGIN") ?></h3>
  <input class="form-control" id="username" type="text" name="username" placeholder="<?= lang("ADMIN_USER") ?>"
    autocomplete="off">
  <input class="form-control" id="password" type="password" name="password" placeholder="<?= lang("ADMIN_PASS") ?>"
    autocomplete=" new-password">
  <input class="btn btn-primary btn-block" type="submit" value="<?= lang('LOG_BTN') ?>" />
</form>
<?php include $temp . ('footer.php'); ?>