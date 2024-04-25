<?php

/*
  ================================================
  == Mange Members Page
  == You Can Add | Edit | Delete Members From Here
  ================================================
*/

session_start();
$pageTitle = 'Members';
// Check If The User Is Logged In
if (isset($_SESSION['user_name'])):
  // Include Required Files
  include ('init.php');

  $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

  // Start Manage Page
  if ($do == 'Manage'):
    echo "Your Are In Manage Page <br>";
    echo "<a href='?do=Add' class='btn btn-primary'>Add New Member</a>";

  elseif ($do == 'Add'): // Add Page
    ?>
    <div class="container add-container">
      <h1><?php echo lang("ADD_MEMBER") ?></h1>
      <form action="members.php?do=Insert" method="POST">
        <!-- Start Username -->
        <div class="mb-3">
          <label for="username" class="form-label"><?php echo lang("ADD_USER") ?></label>
          <div class="input-wrapper">
            <input type="text" class="form-control" id="username" name="username" autocomplete="off" 
              placeholder="<?php echo lang("ADD_USER_PLACEHOLDER") ?>">
          </div>
        </div>
        <!-- End Username -->
        <!-- Start Password -->
        <div class="mb-3">
          <label for="password" class="form-label"><?php echo lang("ADD_PASS") ?></label>
          <div class="input-wrapper">
            <input type="password" class="form-control" id="password" name="password"  autocomplete="new-password"
              placeholder="<?php echo lang("ADD_PASS_PLACEHOLDER") ?>">
          </div>
        </div>
        <!-- End Password -->
        <!-- Start Email -->
        <div class="mb-3 input-container">
          <label for="email" class="form-label"><?php echo lang("ADD_EMAIL") ?></label>
          <div class="input-wrapper">
            <input type="email" class="form-control" id="email" name="email" autocomplete="off" 
              placeholder="<?php echo lang("ADD_EMAIL_PLACEHOLDER") ?>">
          </div>
        </div>
        <!-- End Email -->
        <!-- Start Full Name -->
        <div class="mb-3">
          <label for="fullname" class="form-label"><?php echo lang("ADD_FULL_NAME") ?></label>
          <div class="input-wrapper">
            <input type="text" class="form-control" id="fullname" name="fullname" autocomplete="off" 
              placeholder="<?php echo lang("ADD_FULL_PLACEHOLDER") ?>">
          </div>
        </div>
        <!-- End Full Name -->
        <button type="submit" class="btn btn-primary "><?php echo lang("ADD_BTN") ?></button> <!-- Submit Button -->

      </form>
    </div>
    <?php

  elseif ($do == "Insert"):
    if ($_SERVER['REQUEST_METHOD'] == 'POST'):
      echo "<h1>" . lang("INSERT_MEMBER") . "</h1>";
      // Get The Variables From The Form
      $username = $_POST['username'];
      $password = $_POST['password'];
      $email = $_POST['email'];
      $fullname = $_POST['fullname'];
      $hashPassword = sha1($password);

      // Check Form Validation
      $formErrors = array();
      // Check Username
      if (empty($username)):
        $formErrors[] = lang("USERNAME_EMPTY");
      elseif (strlen($username) < 4):
        $formErrors[] = lang("USERNAME_LESS");
      elseif (strlen($username) > 20):
        $formErrors[] = lang("USERNAME_MORE");
      endif;
      // Check Password
      if (empty($password)):
        $formErrors[] = lang("PASSWORD_EMPTY");
      endif;
      // Check Email
      if (empty($email)):
        $formErrors[] = lang("EMAIL_EMPTY");
      endif;
      // Check Full Name
      if (empty($fullname)):
        $formErrors[] = lang("FULLNAME_EMPTY");
      endif;

      // Loop Into Errors Array And Echo It
      foreach ($formErrors as $error):
        echo "<div class='alert alert-danger'>" . $error . "</div>";
      endforeach;

      // If Thers Is No Errors Edit The Member In Database
      if (empty($formErrors)):
        // Prepare The Update Query
        
      endif;
    endif;

  elseif ($do == 'Edit'): // Edit Page 

    $userid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    // Prepare The Statement To Execute It [1]
    $stmt = $connect->prepare('SELECT * FROM users WHERE user_id = ? LIMIT 1');

    $stmt->execute(array($userid)); // Execute The Statement [2]
    $row = $stmt->fetch(); // Fetch The Data [3]
    $rowCount = $stmt->rowCount(); // Get The Count Of The Rows [4]

    if ($rowCount > 0): ?>

      <div class="container edit-container">
        <h1><?php echo lang("EDIT_MEMBER") ?></h1>
        <form action="?do=Update" method="POST">
          <input type="hidden" name="userid" value="<?php echo $userid ?>">
          <!-- Start Username -->
          <div class="mb-3">
            <label for="username" class="form-label"><?php echo lang("EDIT_USER") ?></label>
            <div class="input-wrapper">
              <input type="text" class="form-control" id="username" name="username" autocomplete="off"
                value="<?php echo $row['user_name'] ?>" Required>
            </div>
          </div>
          <!-- End Username -->
          <!-- Start Password -->
          <div class="mb-3">
            <label for="password" class="form-label"><?php echo lang("EDIT_PASS") ?></label>
            <input type="hidden" name="oldpassword" class="form-control" value="<?php echo $row['pass'] ?>">
            <input type="password" class="form-control" id="password" name="newpassword" autocomplete="new-password"
              placeholder="<?php echo lang("PASS_MESSAGE") ?>">
          </div>
          <!-- End Password -->
          <!-- Start Email -->
          <div class="mb-3 input-container">
            <label for="email" class="form-label"><?php echo lang("EDIT_EMAIL") ?></label>
            <div class="input-wrapper">
              <input type="email" class="form-control" id="email" name="email" autocomplete="off"
                value="<?php echo $row['email'] ?>" Required>
            </div>
          </div>
          <!-- End Email -->
          <!-- Start Full Name -->
          <div class="mb-3">
            <label for="fullname" class="form-label"><?php echo lang("EDIT_FULL_NAME") ?></label>
            <div class="input-wrapper">
              <input type="text" class="form-control" id="fullname" name="fullname" autocomplete="off"
                value="<?php echo $row['full_name'] ?>" Required>
            </div>
          </div>
          <!-- End Full Name -->
          <button type="submit" class="btn btn-primary "><?php echo lang("EDIT_BTN") ?></button> <!-- Submit Button -->

        </form>
      </div>

      <?php
    else:
      echo "<div class='alert alert-warning text-center'>" . lang("ID_NOT_FOUND_WARNING") . "</div>";
      header('refresh:3;url=members.php');
    endif;
  elseif ($do = 'Update'): // Update Page
    echo "<div class='container'>";

    if ($_SERVER['REQUEST_METHOD'] == 'POST'):
      echo "<h1>" . lang("UPDATE_MEMBER") . "</h1>";
      // Get The Variables From The Form
      $userid = $_POST['userid'];
      $username = $_POST['username'];
      $email = $_POST['email'];
      $fullname = $_POST['fullname'];

      // Password Trick
      $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);

      // Check Form Validation
      $formErrors = array();
      // Check Username
      if (empty($username)):
        $formErrors[] = lang("USERNAME_EMPTY");
      elseif (strlen($username) < 4):
        $formErrors[] = lang("USERNAME_LESS");
      elseif (strlen($username) > 20):
        $formErrors[] = lang("USERNAME_MORE");
      endif;
      // Check Email
      if (empty($email)):
        $formErrors[] = lang("EMAIL_EMPTY");
      endif;
      // Check Full Name
      if (empty($fullname)):
        $formErrors[] = lang("FULLNAME_EMPTY");
      endif;

      // Loop Into Errors Array And Echo It
      foreach ($formErrors as $error):
        echo "<div class='alert alert-danger'>" . $error . "</div>";
      endforeach;

      // If Thers Is No Errors Edit The Member In Database
      if (empty($formErrors)):

        // Prepare The Update Query
        $stmt = $connect->prepare('UPDATE users SET user_name = ?, email = ?, full_name = ?, pass = ? WHERE user_id = ?');

        // Get Old Data To Compare It With The New Data To Check If The User Change The Username Or Email, etc...
        $oldValues = $connect->prepare('SELECT user_name, pass ,email, full_name FROM users WHERE user_id = ?');
        $oldValues->execute(array($userid));
        $oldData = $oldValues->fetch();

        // Create Array Contain Success Messages
        $successMessages = array();

        // Check If The Username Is Updated
        if ($username !== $oldData['user_name']):
          $successMessages[] = lang("UPDATE_USERNAME_SUCCESS");
        endif;

        // Check If The Password Is Updated
        if ($pass !== $oldData['pass']):
          $successMessages[] = lang("UPDATE_PASS_SUCCESS");
        endif;

        // Check If The Email Is Updated
        if ($email !== $oldData['email']):
          $successMessages[] = lang("UPDATE_EMAIL_SUCCESS");
        endif;

        // Check If The Full Name Is Updated
        if ($fullname !== $oldData['full_name']):
          $successMessages[] = lang("UPDATE_FULLNAME_SUCCESS");
        endif;


        // Execute The Query
        $stmt->execute(array($username, $email, $fullname, $pass, $userid));
        // Echo Success Message

        foreach ($successMessages as $message):
          echo "<div class='alert alert-success'>" . $message . "</div>";
        endforeach;

        // echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' ' . lang("UPDATE_SUCCESS") . "</div>";
      endif;

    else:
      echo "<div class='alert alert-warning text-center'>" . lang("UPDATE_PAGE_WARNING") . "</div>";
      header('refresh:3;url=members.php');
    endif;
  endif;
  echo "</div>";

  include $temp . ('footer.php');

else:
  // Redirect To Login Page If The User Is Not Admin.
  header('Location: index.php');
  exit();
endif;