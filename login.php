<?php
session_start();
$pageTitle = 'User Login';

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

  $stmt = $connect->prepare('SELECT user_name, pass FROM users WHERE user_name = ? AND pass = ?');
  $stmt->execute([$username, $hashedPassword]);
  $count = $stmt->rowCount();

  if ($count > 0) :
    $_SESSION['user_name'] = $username;
    header('Location: index.php');
    exit();
  endif;
endif;
?>


<div class="login-page">
  <div class="container">
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" id="loginForm">
      <h3 class="text-center"><?= lang('USER_LOGIN') ?></h3>
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
      <hr>
      <a class='signup-btn text-decoration-none text-white btn btn-success text-center m-auto' href="signup.php">
        <?= lang('SIGNUP_BTN') ?>
      </a>
    </form>

  </div>
</div>

<?php
include $temp . 'footer.php';
?>