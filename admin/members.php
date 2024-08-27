<?php

/*
  ================================================
  == Mange Members Page
  == You Can Add | Edit | Delete Members From Here
  ================================================
*/

ob_start(); // Output Buffering Start
session_start();
$pageTitle = 'Members';
// Check If The User Is Logged In
if (isset($_SESSION['admin_name'])) :
  // Include Required Files
  include 'init.php';

  $do = $_GET['do'] ?? 'Manage';

  // Start Manage Page
  if ($do == 'Manage') :

    // Check If The User Not Approved Yet
    // If It Is Pending Show Pending Members Only
    $query = '';
    if (isset($_GET['page']) && $_GET['page'] == 'Pending') :
      $query = 'AND reg_status = 0';
    endif;

    // Define allowed columns and order directions
    $allowedColumns = ['user_id', 'user_name', 'email', 'ordering', 'full_name', 'add_date'];
    $allowedOrders = ['ASC', 'DESC'];

    // Sanitize and validate the input
    $sort_col = $_GET['sort_col'] ?? 'user_id';
    $sort_order = $_GET['sort_order'] ?? 'ASC';

    // Check if the input values are allowed
    if (!in_array($sort_col, $allowedColumns) || !in_array($sort_order, $allowedOrders)) {
      $sort_col = 'user_id';
      $sort_order = 'ASC';
    }

    // Get The Data From The Database
    $stmt = $connect->prepare("SELECT * FROM users WHERE group_id != 1 $query ORDER BY $sort_col $sort_order");
    $stmt->execute();
    $rows = $stmt->fetchAll();

?>
    <div class="container cat-container">
      <h1><?= lang("MANAGE_MEMBERS") ?></h1>
      <div class="container ">
        <!-- Start Sorting Form -->
        <form action="members.php" method='GET'>
          <div class="row mb-4">
            <div class="col-md-5">
              <select name="sort_col" class='form-select'>
                <option value="user_id" <?= ($sort_col == 'user_id') ? 'selected' : ''; ?>><?= lang('ID_MANAGE') ?>
                </option>
                <option value="user_name" <?= ($sort_col == 'user_name') ? 'selected' : ''; ?>>
                  <?= lang('USERNAME_MANAGE') ?>
                </option>
                <option value="email" <?= ($sort_col == 'email') ? 'selected' : ''; ?>>
                  <?= lang('EMAIL_MANAGE') ?>
                </option>
                <option value="full_name" <?= ($sort_col == 'full_name') ? 'selected' : ''; ?>>
                  <?= lang('FULLNAME_MANAGE') ?>
                </option>
                <option value="add_date" <?= ($sort_col == 'add_date') ? 'selected' : ''; ?>>
                  <?= lang('DATE_MANAGE') ?>
                </option>
              </select>
            </div>
            <div class="col-md-5">
              <select name="sort_order" class="form-select">
                <option value="ASC" <?= ($sort_order == 'ASC') ? 'selected' : ''; ?>><?= lang('SORT_ASC') ?>
                </option>
                <option value="DESC" <?= ($sort_order == 'DESC') ? 'selected' : ''; ?>><?= lang('SORT_DESC') ?>
                </option>
              </select>
            </div>
            <div class="col-md-2 custom-btn">
              <button type="submit" class="btn btn-primary"><?= lang("SORT_BTN") ?></button>
            </div>
          </div>
        </form>
        <!-- End Sorting Form -->
      </div>
      <div class="container">
        <div class="table-responsive">
          <table class="main-table text-center table table-striped table-hover table-bordered">
            <thead>
              <tr>
                <td><?= lang("ID_MANAGE") ?></td>
                <td><?= lang("AVATAR_MANAGE") ?></td>
                <td><?= lang("USERNAME_MANAGE") ?></td>
                <td><?= lang("EMAIL_MANAGE") ?></td>
                <td><?= lang("FULLNAME_MANAGE") ?></td>
                <td><?= lang("DATE_MANAGE") ?></td>
                <td><?= lang("CONTROL_MANAGE") ?></td>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($rows as $row) :
                echo "<tr class='custom-row'>";
                echo "<td>" . $row['user_id'] . "</td>";
                echo "<td>";
                if (!empty($row['user_image'])) :
                  echo "<img src='../uploads/userImage/" . $row['user_image'] . "' alt='unknown' />";
                else :
                  echo "<img src='../uploads/userImage/default.jpg' alt='unknown' />";
                endif;
                echo "</td>";
                echo "<td>" . $row['user_name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['full_name'] . "</td>";
                echo "<td>" . $row['add_date'] . "</td>";
                echo "<td>
                        <a href='?do=Edit&id=" . $row['user_id'] . "' class='btn btn-success control_field'> <i class='fa fa-edit'></i> </a>
                        <a href='?do=Delete&id=" . $row['user_id'] . "'
                          onclick='return confirm(\"" . lang("DELETE_MEMBER_CONFIRMATION") . "\")'
                          class='btn btn-danger control_field'> <i class='fa fa-trash'></i></a> ";
                if ($row['reg_status'] == 0) :
                  echo "<a href='?do=Activate&id=" . $row['user_id'] . "'
                            onclick='return confirm(\"" . lang("ACTIVATE_MEMBER_CONFIRMATION") . "\")'
                            class='btn btn-info control_field'> <i class='fa fa-check'></i></a>";
                endif;
                echo "</td>";
                echo "</tr>";
              endforeach;
              ?>
            </tbody>
          </table>
        </div>
        <a href='?do=Add' class='btn btn-primary mb-5'> <i class="fa fa-plus"> </i> <?= lang("ADD_MEMBER") ?> </a>
      </div>

    <?php elseif ($do == 'Add') : // Add Page 
    ?>
      <div class="container add-container">
        <h1><?= lang("ADD_MEMBER") ?></h1>
        <form action="members.php?do=Insert" method="POST" enctype="multipart/form-data">
          <!-- Start Username -->
          <div class="mb-3">
            <label for="username" class="form-label"><?= lang("ADD_USER") ?></label>
            <div class="input-wrapper">
              <input
                pattern=".{4,20}"
                title="<?= lang("USERNAME_LENGTH") ?>"
                type="text"
                class="form-control"
                id="username"
                name="username"
                autocomplete="off"
                required
                placeholder="<?= lang("ADD_USER_PLACEHOLDER") ?>"
                autocomplete="off">
            </div>
          </div>
          <!-- End Username -->
          <!-- Start Password -->
          <div class="mb-3">
            <label for="password" class="form-label"><?= lang("ADD_PASS") ?></label>
            <div class="input-wrapper">
              <input
                type="password"
                class="form-control"
                id="password"
                minlength="4"
                name="password"
                autocomplete="new-password"
                required
                placeholder="<?= lang("ADD_PASS_PLACEHOLDER") ?>">
            </div>
          </div>
          <!-- End Password -->
          <!-- Start Email -->
          <div class="mb-3 input-container">
            <label for="email" class="form-label"><?= lang("ADD_EMAIL") ?></label>
            <div class="input-wrapper">
              <input
                type="email"
                class="form-control"
                id="email"
                name="email"
                autocomplete="off"
                required
                placeholder="<?= lang("ADD_EMAIL_PLACEHOLDER") ?>"
                autocomplete="off">
            </div>
          </div>
          <!-- End Email -->
          <!-- Start Full Name -->
          <div class="mb-3">
            <label for="fullname" class="form-label"><?= lang("ADD_FULL_NAME") ?></label>
            <div class="input-wrapper">
              <input
                pattern=".{4,20}"
                title="<?= lang("FULLNAME_LENGTH") ?>"
                type="text"
                class="form-control"
                id="fullname"
                name="fullname"
                autocomplete="off"
                required
                placeholder="<?= lang("ADD_FULL_PLACEHOLDER") ?>">
            </div>
          </div>
          <!-- End Full Name -->
          <!-- Start User Image Filed -->
          <div class="mb-3">
            <label for="fullname" class="form-label"><?= lang("ADD_AVATAR") ?></label>
            <div class="input-wrapper">
              <input
                type="file"
                class="form-control"
                id="userImage"
                name="userImage"
                autocomplete="off"
                required>
            </div>
          </div>
          <!-- End User Image Filed -->
          <!-- Start Submit Button -->
          <button type="submit" class="btn btn-primary"> <i class='fa fa-plus'>
            </i> <?= lang("ADD_MEMBER_BTN") ?></button>
          <!-- End Submit Button -->
        </form>
      </div>
      <?php

    elseif ($do == "Insert") :
      if ($_SERVER['REQUEST_METHOD'] == 'POST') :
        echo "<h1>" . lang("INSERT_MEMBER") . "</h1>";

        // Upload Variables

        $imageName = $_FILES['userImage']['name'];
        $imageSize = $_FILES['userImage']['size'];
        $imageTmp = $_FILES['userImage']['tmp_name'];
        $imageType = $_FILES['userImage']['type'];
        $allowedExtensions = ["jpeg", "jpg", "png"];

        // Get Image Extension
        $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        // Get The Variables From The Form && Make Sanitize For The Data For Security Reasons
        $username = strip_tags($_POST['username']);
        $password = $_POST['password'];
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $fullname = strip_tags($_POST['fullname']);
        $hashPassword = sha1($password);

        // Check Form Validation
        $formErrors = [];
        // Check Username
        $check = checkItem('user_name', 'users', $username);
        if ($check > 0) :
          $formErrors[] = lang('USER_EXIST');
        endif;
        if (empty($username)) :
          $formErrors[] = lang("USERNAME_EMPTY");
        elseif (strlen($username) < 4 || strlen($username) > 20) :
          $formErrors[] = lang("USERNAME_LENGTH");
        endif;
        // Check Password
        if (empty($password)) :
          $formErrors[] = lang("PASSWORD_EMPTY");
        elseif (strlen($password) < 4) :
          $formErrors[] = lang("PASSWORD_LENGTH");
        endif;
        // Check Email
        if (empty($email)) :
          $formErrors[] = lang("EMAIL_EMPTY");
        endif;
        // Check Full Name
        if (empty($fullname)) :
          $formErrors[] = lang("FULLNAME_EMPTY");
        endif;
        // Check Image Extension
        if (empty($imageName)):
          $formErrors[] = lang("IMAGE_EMPTY");
        elseif (! empty($imageName) && ! in_array($imageExtension, $allowedExtensions)):
          $formErrors[] = lang("NOT_ALLOWED_EXTENSIONS");
        elseif ($imageSize > 4194304):
          $formErrors[] = lang("IMAGE_SIZE");
        endif;


        // If Thers Is No Errors Edit The Member In Database
        if (!empty($formErrors)) :
          redirectFuncError($formErrors, 'back');
        else :
          $avatar = rand(0, 1000000) . "_" . $imageName;

          move_uploaded_file($imageTmp, "/mnt/life/Learn-Programming/Back-End/BackEnd_Projects/eCommerce/uploads/userImage/{$avatar}");
          //Prepare The Insert Query
          $stmt = $connect->prepare("INSERT INTO
                                        users (user_name, pass, email, full_name, reg_status,add_date, user_image)
                                      VALUES 
                                        (?, ?, ?, ?, 1,now(), ?)");
          // Execute The Query
          $stmt->execute([$username, $hashPassword, $email, $fullname, $avatar]);
          // Echo Success Message
          redirectFuncSuccess($username . ' ' . lang("INSERT_SUCCESS_MESSAGE"), 'members.php');
        endif;
      else :
        redirectFuncError(lang("DIRECT_LINK"), 'members.php', 5);
      endif;

    elseif ($do == 'Edit') : // Edit Page 

      // Check If Get Request userid Is Numeric & Get The Integer Value Of It
      $userid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
      // Prepare The Statement To Execute It [1]
      $stmt = $connect->prepare('SELECT * FROM users WHERE user_id = ? LIMIT 1');
      $stmt->execute([$userid]); // Execute The Statement [2]
      $row = $stmt->fetch(); // Fetch The Data [3]
      $rowCount = $stmt->rowCount(); // Get The Count Of The Rows [4]

      if ($rowCount > 0) : ?>

        <div class="container edit-container">
          <h1><?= lang("EDIT_MEMBER") ?></h1>
          <form action="?do=Update" method="POST">
            <input type="hidden" name="userid" value="<?= $userid ?>">
            <!-- Start Username -->
            <div class="mb-3">
              <label for="username" class="form-label"><?= lang("EDIT_USER") ?></label>
              <div class="input-wrapper">
                <input
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
              <input
                type="password"
                class="form-control"
                id="password"
                name="newpassword"
                autocomplete="new-password"
                placeholder="<?= lang("PASS_MESSAGE") ?>">
            </div>
            <!-- End Password -->
            <!-- Start Email -->
            <div class="mb-3 input-container">
              <label for="email" class="form-label"><?= lang("EDIT_EMAIL") ?></label>
              <div class="input-wrapper">
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  name="email"
                  autocomplete="off"
                  value="<?= $row['email'] ?>"
                  Required>
              </div>
            </div>
            <!-- End Email -->
            <!-- Start Full Name -->
            <div class="mb-3">
              <label for="fullname" class="form-label"><?= lang("EDIT_FULL_NAME") ?></label>
              <div class="input-wrapper">
                <input
                  type="text"
                  class="form-control"
                  id="fullname"
                  name="fullname"
                  autocomplete="off"
                  value="<?= $row['full_name'] ?>"
                  Required>
              </div>
            </div>
            <!-- End Full Name -->
            <button type="submit" class="btn btn-primary  "> <i class='fa fa-edit'></i> <?= lang("UPDATE_BTN") ?></button>
            <!-- Submit Button -->

          </form>
        </div>

  <?php
      else :
        redirectFuncError(lang("ID_NOT_FOUND_WARNING"), 'members.php');
      endif;
    elseif ($do == 'Update') : // Update Page
      echo "<div class='container'>";

      if ($_SERVER['REQUEST_METHOD'] == 'POST') :
        echo "<h1>" . lang("UPDATE_MEMBER") . "</h1>";
        // Get The Variables From The Form
        $userid = $_POST['userid']; // The Id Sanitized In Line 232
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
          $oldValues->execute(array($userid));
          $oldData = $oldValues->fetch();

          // Create Array Contain Success Messages
          $successMessages = array();

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
          $stmt->execute(array($username, $email, $fullname, $pass, $userid));
          // Echo Success Message

          redirectFuncSuccess($successMessages, 'members.php');

        endif;

      else :
        redirectFuncError(lang("DIRECT_LINK"), 'members.php', 5);
      endif;

    elseif ($do == 'Delete') : // Delete Page
      echo "<div class='container'>";
      // Check If Get Request userid Is Numeric & Get The Integer Value Of It
      $userid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;

      $check = checkItem('user_id', 'users', $userid);

      if ($check > 0) :
        echo '<h1>' . lang("DELETE_MEMBER") . '</h1>';
        // Get The Username Of The User
        $username = getName('user_name', 'users', 'user_id', $userid);
        $stmt = $connect->prepare('DELETE FROM users WHERE user_id = ?'); // Prepare The Delete Query
        $stmt->execute(array($userid)); // Execute The Query
        redirectFuncSuccess($username . ' ' . lang("DELETE_MEMBER_SUCCESS"), 'members.php');
      else :
        redirectFuncError(lang("ID_NOT_FOUND_WARNING"), 'members.php');
      endif;
      echo "</div>";
    elseif ($do == 'Activate') : // Activate Page
      // Check If Get Request userid Is Numeric & Get The Integer Value Of It
      $userid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;

      $check = checkItem('user_id', 'users', $userid);

      if ($check > 0) :
        echo "<div class='container'>";
        echo '<h1>' . lang("ACTIVATE_MEMBER") . '</h1>';
        echo '</div>';

        // Get The User ID
        $stmt = $connect->prepare('UPDATE users SET reg_status = 1 WHERE user_id = ?'); // Prepare The Update Query
        $stmt->execute(array($userid)); // Execute The Query
        redirectFuncSuccess(getName('user_name', 'users', 'user_id', $userid) . ' ' . lang("ACTIVATE_MEMBER_SUCCESS"));
      else :
        redirectFuncError(lang("ID_NOT_FOUND_WARNING"), 'members.php');
      endif;

    endif;
    echo "</div>";

    include $temp . ('footer.php');

  else :
    // Redirect To Login Page If The User Is Not Admin.
    // redirectFuncError(null, 'index.php', );
    header('Location: index.php');
    exit();
  endif;
  ob_end_flush(); // Release The Output