<?php
ob_start();
session_start();
$pageTitle = 'Sign Up';
include 'init.php';
global $connect;

if ($_SERVER['REQUEST_METHOD'] == 'POST') :
  $formErrors = [];
  $username = strip_tags($_POST['username']);
  $fullname = strip_tags($_POST['fullname']);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  if (empty($username)) :
    $formErrors[] = lang('USERNAME_EMPTY');
  elseif (strlen($username) < 4) :
    $formErrors[] = lang('USERNAME_LESS');
  elseif (strlen($username) > 20) :
    $formErrors[] = lang('USERNAME_MORE');
  endif;

  if (empty($fullname)) :
    $formErrors[] = lang('FULLNAME_EMPTY');
  elseif (strlen($fullname) < 4) :
    $formErrors[] = lang('FULLNAME_LESS');
  elseif (strlen($fullname) > 50) :
    $formErrors[] = lang('FULLNAME_MORE');
  endif;

  if (empty($email)) :
    $formErrors[] = lang('EMAIL_EMPTY');
  /*
      Use FILTER_VALIDATE_EMAIL to ensure the email standrad format is correct
    */
  elseif (filter_var($email, FILTER_VALIDATE_EMAIL) != true) :
    $formErrors[] = lang('EMAIL_INVALID');
  endif;

  if (isset($password) && isset($confirm_password)) :
    // Check before make hashing because empty input have it's own hash => so the error message never showing
    if (empty($password)) :
      $formErrors[] = lang('PASSWORD_EMPTY');
    endif;
    if (sha1($password) !== sha1($confirm_password)) :
      $formErrors[] = lang('PASSWORD_NOT_MATCH');
    endif;
  endif;

  if (empty($formErrors)):
    $check = checkItem('user_name', 'users', $username);
    if ($check === 1):
      $formErrors[] = lang("USER_EXIST");
    else:
      $stmt = $connect->prepare("INSERT INTO users
                                    (user_name, full_name, email, pass, reg_status, add_date) 
                                  VALUES 
                                    (:zuser, :zname, :zemail, :zpass, 0, now())");
      $stmt->execute([
        'zuser' => $username,
        'zname' => $fullname,
        'zemail' => $email,
        'zpass' => sha1($password)
      ]);
      redirectFuncSuccess(lang("USER_CREATED"), 'login.php', 3);
    endif;
  endif;

endif;
?>

<div class="login-page">
  <div class="container">
    <!-- Signup Form -->
    <form id="signupForm" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
      <h2 class="text-center sing-up"><?= lang('USER_SIGNUP') ?></h2>
      <div class="form-group">
        <input pattern=".{4,20}" title="User Name Must Be 4 - 20 Characters" id="username" type="text" class="form-control" placeholder="<?= lang('USERNAME') ?>" name="username" required>
        <span id="username-error"></span>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="<?= lang('FULLNAME') ?>" name="fullname" required>
      </div>
      <div class="form-group">
        <input type="email" class="form-control" placeholder="<?= lang('EMAIL') ?>" name="email" required>
      </div>
      <div class="form-group">
        <input minlength="4" type="password" class="form-control" placeholder="<?= lang('USER_PASS') ?>" name="password" required>
      </div>
      <div class="form-group">
        <input minlength="4" type="password" class="form-control" placeholder="<?= lang('CONFIRM_PASS') ?>" name="confirm_password" required>
      </div>
      <div class="form-group">
        <button type="submit" class="user-signup-btn btn btn-primary btn-block w-100"><?= lang('USER_SIGNUP_BTN') ?>
        </button>
      </div>
      <?php
      if (!empty($formErrors)) :
        printErrors();
      endif;
      ?>
    </form>
  </div>
</div>

<?php
include "{$temp}footer.php";
ob_end_flush();
?>