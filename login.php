<?php
ob_start();
session_start();
$pageTitle = 'User Login';
global $connect;

// Check If The User Is Logged In And Redirect To Homepage Page Automatically
if (isset($_SESSION['user_name'])) :
  header('Location: index.php');
  exit();
endif;
include 'init.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') :
  $username = $_POST['username'];
  $password = $_POST['password'];
  $hashedPassword = sha1($password);

  $stmt = $connect->prepare('SELECT user_id, user_name, pass FROM users WHERE user_name = ? AND pass = ?');
  $stmt->execute([$username, $hashedPassword]);
  $get = $stmt->fetch();
  $count = $stmt->rowCount();

  if ($count > 0) :
    $_SESSION['user_name'] = $username;
    $_SESSION['user_id'] = $get['user_id'];
    header('Location: index.php');
    exit();
  else :
    $errorMsg = "Username or password incorrect";
  endif;
endif;
?>


<div class="login-page">
  <div class="container">
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" id="loginForm">
      <h2 class="text-center"><?= lang('USER_LOGIN') ?></h2>
      <div class="form-group">
        <input type="text" class="form-control" name="username" placeholder="<?= lang('USERNAME') ?>" required>
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="<?= lang('USER_PASS') ?>" required>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block w-100">
          <?= lang('LOGIN_BTN') ?>
        </button>
      </div>
      <?php if (isset($errorMsg)) :
        echo "<div class='errors alert alert-danger'>$errorMsg</div>";
      endif; ?>
      <hr>
      <a class='user-signup-btn text-decoration-none text-white btn btn-success text-center m-auto' href="signup.php">
        <?= lang('SIGNUP_BTN') ?>
      </a>

    </form>

  </div>
</div>

<?php
include "{$temp}footer.php";
ob_end_flush();
?>