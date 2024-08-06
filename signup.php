<?php
session_start();
$pageTitle = 'User Sign Up';
include 'init.php';
?>


<div class="login-page">
  <div class="container">
    <!-- Signup Form -->
    <form id="signupForm" method="POST">
      <h3 class="text-center"><?= lang('USER_SIGNUP') ?></h3>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="<?= lang('USERNAME') ?>" required>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="<?= lang('FULLNAME') ?>" required>
      </div>
      <div class="form-group">
        <input type="email" class="form-control" placeholder="<?= lang('EMAIL') ?>" required>
      </div>
      <div class="form-group">
        <input type="password" class="form-control" placeholder="<?= lang('USER_PASS') ?>" required>
      </div>
      <div class="form-group">
        <input type="password" class="form-control" placeholder="<?= lang('CONFIRM_PASS') ?>" required>
      </div>
      <div class="form-group">
        <button type="submit" class="user-signup-btn btn btn-primary btn-block w-100"><?= lang('USER_SIGNUP_BTN') ?></button>
      </div>
    </form>
  </div>
</div>

<?php
include "{$temp} footer.php";
?>