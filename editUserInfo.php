<?php
ob_start();
session_start();
$pageTitle = 'Edit Profile';
include 'init.php';
global $connect;

if (isset($_SESSION['user_name'])) :
  // Check If Get Request userid Is Numeric & Get The Integer Value Of It
  $userid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;

  // To Ensure The User Can't Access Another Users Data By ID
  if ($userid != $_SESSION['user_id']):
    redirectFuncError(lang("NO_PERMISSION"), 'index.php');
  endif;


  // Prepare The Statement To Execute It [1]
  $stmt = $connect->prepare('SELECT * FROM users WHERE user_id = ? LIMIT 1');
  $stmt->execute([$userid]); // Execute The Statement [2]
  $row = $stmt->fetch(); // Fetch The Data [3]
  $rowCount = $stmt->rowCount(); // Get The Count Of The Rows [4]
  if ($rowCount > 0) : ?>

    <div class="container edit-container">
      <h1><?= lang("EDIT_MEMBER") ?></h1>

      <?php
      if ($_SERVER['REQUEST_METHOD'] == 'POST'):
        $userid = $_POST['userid']; // The Id Sanitized In Line 10
        $username = strip_tags($_POST['username']);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $fullname = strip_tags($_POST['fullname']);
        // Password Trick
        $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);

        // Check Form Validation
        $formErrors = [];
        // Check If Username Is Exist In Database Or Not
        $check = editCheck('user_name', 'users', $username, 'user_id', $userid);
        // Check Username
        if (empty($username)) :
          $formErrors[] = lang("USERNAME_EMPTY");
        elseif ($check > 0) :
          $formErrors[] = lang("USER_EXIST");
        elseif (strlen($username) < 4 || strlen($username) > 20) :
          $formErrors[] = lang("USERNAME_LENGTH");
        endif;
        // Check Email
        if (empty($email)) :
          $formErrors[] = lang("EMAIL_EMPTY");
        endif;
        // Check Full Name
        if (empty($fullname)) :
          $formErrors[] = lang("FULLNAME_EMPTY");
        endif;

        if (!empty($formErrors)) :
          redirectFuncError($formErrors, 'back', 5);
        else :
          // Get Old Data To Compare It With The New Data To Check If The User Change The Username Or Email, etc...
          $oldValues = $connect->prepare('SELECT user_name, pass ,email, full_name FROM users WHERE user_id = ?');
          $oldValues->execute([$userid]);
          $oldData = $oldValues->fetch();

          // Create Array Contain Success Messages
          $successMessages = [];

          // Check If The Username Is Updated
          if ($username !== $oldData['user_name']) :
            $successMessages[] = lang("UPDATE_USERNAME_SUCCESS");
            // Nice Trick To Make The Session Username Equal To The New Username
            $_SESSION['user_naem'] = null;
            $_SESSION['user_name'] = $username;
          endif;

          // Check If The Password Is Updated
          if ($pass !== $oldData['pass']) :
            $successMessages[] = lang("UPDATE_PASS_SUCCESS");
          endif;

          // Check If The Email Is Updated
          if ($email !== $oldData['email']) :
            $successMessages[] = lang("UPDATE_EMAIL_SUCCESS");
          endif;

          // Check If The Full Name Is Updated
          if ($fullname !== $oldData['full_name']) :
            $successMessages[] = lang("UPDATE_FULLNAME_SUCCESS");
          endif;

          // Prepare The Update Query
          $stmt = $connect->prepare('UPDATE users SET user_name = ?, email = ?, full_name = ?, pass = ? WHERE user_id = ?');
          // Execute The Query
          $stmt->execute([$username, $email, $fullname, $pass, $userid]);
          // Echo Success Message

          redirectFuncSuccess($successMessages, 'profile.php');
        endif;
      endif;
      ?>
      <form action="<?= $_SERVER['PHP_SELF'] ?>?id=<?= $_SESSION['user_id'] ?>" method="POST">
        <input type="hidden" name="userid" value="<?= $userid ?>">
        <!-- Start Username -->
        <div class="mb-3">
          <label for="username" class="form-label"><?= lang("EDIT_USER") ?></label>
          <div class="input-wrapper">
            <input
              pattern=".{4,20}"
              title="<?= lang('USERNAME_LENGTH') ?>"
              type="text"
              class="form-control"
              id="username"
              name="username"
              autocomplete="off"
              value="<?= $row['user_name'] ?>"
              Required>
          </div>
        </div>
        <!-- End Username -->
        <!-- Start Password -->
        <div class="mb-3">
          <label for="password" class="form-label"><?= lang("EDIT_PASS") ?></label>
          <input type="hidden" name="oldpassword" class="form-control" value="<?= $row['pass'] ?>">
          <input type="password" class="form-control" id="password" name="newpassword" autocomplete="new-password" placeholder="<?= lang("PASS_MESSAGE") ?>">
        </div>
        <!-- End Password -->
        <!-- Start Email -->
        <div class="mb-3 input-container">
          <label for="email" class="form-label"><?= lang("EDIT_EMAIL") ?></label>
          <div class="input-wrapper">
            <input type="email" class="form-control" id="email" name="email" autocomplete="off" value="<?= $row['email'] ?>" Required>
          </div>
        </div>
        <!-- End Email -->
        <!-- Start Full Name -->
        <div class="mb-3">
          <label for="fullname" class="form-label"><?= lang("EDIT_FULL_NAME") ?></label>
          <div class="input-wrapper">
            <input type="text" class="form-control" id="fullname" name="fullname" autocomplete="off" value="<?= $row['full_name'] ?>" Required>
          </div>
        </div>
        <!-- End Full Name -->
        <button type="submit" class="btn btn-primary  "> <i class='fa fa-edit'></i> <?= lang("UPDATE_BTN") ?></button>
        <!-- Submit Button -->
      </form>
    </div>

<?php
  else :
    redirectFuncError(lang("ID_NOT_FOUND_WARNING"), 'index.php', 5);
  endif;
else :
  header('Location: login.php');
  exit();
endif;
include "{$temp}footer.php";
ob_end_flush();
