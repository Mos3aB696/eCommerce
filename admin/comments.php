<?php

/*
  ================================================
  == Mange Comments Page
  == You Can Edit | Delete | Approve Comments From Here
  ================================================
*/

ob_start(); // Output Buffering Start
session_start();
$pageTitle = 'Comments';
// Check If The User Is Logged In
if (isset($_SESSION['user_name'])):
  // Include Required Files
  include ('init.php');

  $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

  // Start Manage Page
  if ($do == 'Manage'):

    // Check If The User Not Approved Yet

    // Define allowed columns and order directions
    $allowedColumns = ['comment_id', 'comment_content', 'item_connect', 'user_connect', 'add_date'];
    $allowedOrders = ['ASC', 'DESC'];

    // Sanitize and validate the input
    $sort_col = isset($_GET['sort_col']) ? $_GET['sort_col'] : 'comment_id';
    $sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC';

    // Check if the input values are allowed
    if (!in_array($sort_col, $allowedColumns) || !in_array($sort_order, $allowedOrders)) {
      $sort_col = 'comment_id';
      $sort_order = 'ASC';
    }

    $colMap = [
      'item_connect' => 'items.item_name',
      'user_connect' => 'users.user_name'
    ];

    $actualSortCol = $colMap[$sort_col] ?? $sort_col;

    // Get The Data From The Database
    $stmt = $connect->prepare("SELECT 
                                  comments.*,
                                  items.item_name,
                                  users.user_name
                                FROM
                                  comments
                                INNER JOIN
                                  items 
                                ON
                                  comments.item_connect = items.item_id
                                INNER JOIN
                                  users
                                ON
                                  comments.user_connect = users.user_id
                                ORDER BY 
                                  $actualSortCol $sort_order");
    $stmt->execute();
    $rows = $stmt->fetchAll();

    ?>
    <div class="container cat-container">
      <h1><?= lang("MANAGE_COMMENTS") ?></h1>
      <div class="container ">
        <!-- Start Sorting Form -->
        <form action="comments.php" method='GET'>
          <div class="row mb-4">
            <div class="col-md-5">
              <select name="sort_col" class='form-select'>
                <option value="comment_id" <?= ($sort_col == 'comment_id') ? 'selected' : ''; ?>>
                  <?= lang('COMMENT_ID_MANAGE') ?>
                </option>
                <option value="comment_content" <?= ($sort_col == 'comment_content') ? 'selected' : ''; ?>>
                  <?= lang('COMMENT_CONTENT_MANAGE') ?>
                </option>
                <option value="item_connect" <?= ($sort_col == 'item_connect') ? 'selected' : ''; ?>>
                  <?= lang('COMMENT_ITEM_MANAGE') ?>
                </option>
                <option value="user_connect" <?= ($sort_col == 'user_connect') ? 'selected' : ''; ?>>
                  <?= lang('COMMENT_USER_MANAGE') ?>
                </option>
                <option value="date" <?= ($sort_col == 'add_date') ? 'selected' : ''; ?>>
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
                <td><?= lang("COMMENT_ID_MANAGE") ?></td>
                <td><?= lang("COMMENT_CONTENT_MANAGE") ?></td>
                <td><?= lang("COMMENT_ITEM_MANAGE") ?></td>
                <td><?= lang("COMMENT_USER_MANAGE") ?></td>
                <td><?= lang("DATE_MANAGE") ?></td>
                <td><?= lang("CONTROL_MANAGE") ?></td>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($rows as $row):
                echo "<tr>";
                echo "<td>" . $row['comment_id'] . "</td>";
                echo "<td>" . $row['comment_content'] . "</td>";
                echo "<td>" . $row['item_name'] . "</td>";
                echo "<td>" . $row['user_name'] . "</td>";
                echo "<td>" . $row['add_date'] . "</td>";
                echo "<td>
                        <a href='?do=Edit&id=" . $row['comment_id'] . "' class='btn btn-success control_field'> <i class='fa fa-edit'></i> </a>
                        <a href='?do=Delete&id=" . $row['comment_id'] . "'
                          onclick='return confirm(\"" . lang("DELETE_MEMBER_CONFIRMATION") . "\")'
                          class='btn btn-danger control_field'> <i class='fa fa-trash'></i></a> ";
                if ($row['comment_status'] == 0):
                  echo "<a href='?do=Approve&id=" . $row['comment_id'] . "'
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
      </div>

      <?php
  elseif ($do == 'Edit'): // Edit Page 

    // Check If Get Request commentid Is Numeric & Get The Integer Value Of It
    $commentid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    // Prepare The Statement To Execute It [1]
    $stmt = $connect->prepare('SELECT * FROM comments WHERE comment_id = ? LIMIT 1');
    $stmt->execute(array($commentid)); // Execute The Statement [2]
    $row = $stmt->fetch(); // Fetch The Data [3]
    $rowCount = $stmt->rowCount(); // Get The Count Of The Rows [4]

    if ($rowCount > 0): ?>

        <div class="container edit-container">
          <h1><?= lang("EDIT_COMMENTS") ?></h1>
          <form action="?do=Update" method="POST">
            <input type="hidden" name="commentid" value="<?= $commentid ?>">
            <!-- Start Username -->
            <div class="mb-3">
              <label for="comment_content" class="form-label"><?= lang("EDIT_COMMENT") ?></label>
              <div class="input-wrapper">
                <input type="text" class="form-control" id="comment_content" name="comment_content" autocomplete="off"
                  value="<?= $row['comment_content'] ?>" Required>
              </div>
            </div>
            <!-- End Username -->
            <!-- Start Password -->
            <div class="mb-3">
              <label for="password" class="form-label"><?= lang("EDIT_PASS") ?></label>
              <input type="password" class="form-control" id="password" name="newpassword" autocomplete="new-password"
                placeholder="<?= lang("PASS_MESSAGE") ?>">
            </div>
            <!-- End Password -->
            <!-- Start Email -->
            <div class="mb-3 input-container">
              <label for="email" class="form-label"><?= lang("EDIT_EMAIL") ?></label>
              <div class="input-wrapper">
                <input type="email" class="form-control" id="email" name="email" autocomplete="off"
                  value="<?= $row['email'] ?>" Required>
              </div>
            </div>
            <!-- End Email -->
            <!-- Start Full Name -->
            <div class="mb-3">
              <label for="fullname" class="form-label"><?= lang("EDIT_FULL_NAME") ?></label>
              <div class="input-wrapper">
                <input type="text" class="form-control" id="fullname" name="fullname" autocomplete="off"
                  value="<?= $row['full_name'] ?>" Required>
              </div>
            </div>
            <!-- End Full Name -->
            <button type="submit" class="btn btn-primary  "> <i class='fa fa-edit'></i> <?= lang("UPDATE_BTN") ?></button>
            <!-- Submit Button -->

          </form>
        </div>

        <?php
    else:
      redirectFuncError(lang("ID_NOT_FOUND_WARNING"), 'comments.php');
    endif;
  elseif ($do == 'Update'): // Update Page
    echo "<div class='container'>";

    if ($_SERVER['REQUEST_METHOD'] == 'POST'):
      echo "<h1>" . lang("UPDATE_MEMBER") . "</h1>";
      // Get The Variables From The Form
      $userid = $_POST['userid']; // The Id Sanitized In Line 190
      $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
      $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
      $fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_STRING);

      // Password Trick
      $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);

      // Check Form Validation
      $formErrors = array();
      // Check If Username Is Exist In Database Or Not
      $check = editCheck('user_name', 'users', $username, 'user_id', $userid);
      // Check Username
      if (empty($username)):
        $formErrors[] = lang("USERNAME_EMPTY");
      elseif ($check > 0):
        $formErrors[] = lang("USER_EXIST");
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

      if (!empty($formErrors)):
        redirectFuncError($formErrors, 'back', 5);
      else:
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

        // Prepare The Update Query
        $stmt = $connect->prepare('UPDATE users SET user_name = ?, email = ?, full_name = ?, pass = ? WHERE user_id = ?');
        // Execute The Query
        $stmt->execute(array($username, $email, $fullname, $pass, $userid));
        // Echo Success Message

        redirectFuncSuccess($successMessages, 'comments.php');

      endif;

    else:
      redirectFuncError(lang("DIRECT_LINK"), 'comments.php', 5);
    endif;

  elseif ($do == 'Delete'): // Delete Page
    echo "<div class='container'>";
    // Check If Get Request userid Is Numeric & Get The Integer Value Of It
    $userid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;

    $check = checkItem('user_id', 'users', $userid);

    if ($check > 0):
      echo '<h1>' . lang("DELETE_MEMBER") . '</h1>';
      // Get The Username Of The User
      $username = getName('user_name', 'users', 'user_id', $userid);
      $stmt = $connect->prepare('DELETE FROM users WHERE user_id = ?'); // Prepare The Delete Query
      $stmt->execute(array($userid)); // Execute The Query
      redirectFuncSuccess($username . ' ' . lang("DELETE_MEMBER_SUCCESS"), 'comments.php');
    else:
      redirectFuncError(lang("ID_NOT_FOUND_WARNING"), 'comments.php');
    endif;
    echo "</div>";
  elseif ($do == 'Approve'): // Approve Page
    // Check If Get Request commentid Is Numeric & Get The Integer Value Of It
    $commentid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;

    $check = checkItem('comment_id', 'comments', $commentid);

    if ($check > 0):
      echo "<div class='container'>";
      echo '<h1>' . lang("ACTIVATE_MEMBER") . '</h1>';
      echo '</div>';

      // Get The User ID
      $stmt = $connect->prepare('UPDATE comments SET comment_status = 1 WHERE comment_id = ?'); // Prepare The Update Query
      $stmt->execute(array($commentid)); // Execute The Query
      redirectFuncSuccess(getName('user_name', 'users', 'user_id', $commentid) . ' ' . lang("ACTIVATE_MEMBER_COMMENT_SUCCESS"));
    else:
      redirectFuncError(lang("ID_NOT_FOUND_WARNING"), 'comments.php');
    endif;

  endif;
  echo "</div>";

  include $temp . ('footer.php');

else:
  // Redirect To Login Page If The User Is Not Admin.
  // redirectFuncError(null, 'index.php', );
  header('Location: index.php');
  exit();
endif;
ob_end_flush(); // Release The Output