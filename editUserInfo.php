<?php
ob_start();
session_start();
$pageTitle = 'Edit Profile';
include 'init.php';
global $connect;

if (isset($_SESSION['user_name'])) :
  // Check If Get Request userid Is Numeric & Get The Integer Value Of It
  $userid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
  // Prepare The Statement To Execute It [1]
  $stmt = $connect->prepare('SELECT * FROM users WHERE user_id = ? LIMIT 1');
  $stmt->execute([$userid]); // Execute The Statement [2]
  $row = $stmt->fetch(); // Fetch The Data [3]
  $rowCount = $stmt->rowCount(); // Get The Count Of The Rows [4]
  // http://localhost:5000/editUserInfo.php?do=Update
  if ($rowCount > 0) : ?>

    <div class="container edit-container">
      <h1><?= lang("EDIT_MEMBER") ?></h1>
      <form action="<?= $_SERVER['PHP_SELF'] ?>?id=<?= $_SESSION['user_id'] ?>" method="POST">
        <input type="hidden" name="userid" value="<?= $userid ?>">
        <!-- Start Username -->
        <div class="mb-3">
          <label for="username" class="form-label"><?= lang("EDIT_USER") ?></label>
          <div class="input-wrapper">
            <input type="text" class="form-control" id="username" name="username" autocomplete="off" value="<?= $row['user_name'] ?>" Required>
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

      <?php

      if ($_SERVER['REQUEST_METHOD'] == 'POST'):
        // Get Variables From The Form
        $id = $_POST['userid'];
        $user = $_POST['username'];
        $email = $_POST['email'];
        $name = $_POST['fullname'];
        $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);

        echo $id  . "<br>";
        echo $user . "<br>";
        echo $email . "<br>";
        echo $name . "<br>";
        echo $pass . "<br>";
      endif;


      ?>

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
