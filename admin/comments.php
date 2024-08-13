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
if (isset($_SESSION['admin_name'])) :
  // Include Required Files
  include 'init.php';
  global $connect;

  $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

  // Start Manage Page
  if ($do == 'Manage') :
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
              foreach ($rows as $row) :
                echo "<tr>";
                echo "<td>" . $row['comment_id'] . "</td>";
                echo "<td>" . $row['comment_content'] . "</td>";
                echo "<td>" . $row['item_name'] . "</td>";
                echo "<td>" . $row['user_name'] . "</td>";
                echo "<td>" . $row['add_date'] . "</td>";
                echo "<td>
                        <a href='?do=Edit&id=" . $row['comment_id'] .
                  "' class='btn btn-success control_field'> <i class='fa fa-edit'></i> </a>
                        <a href='?do=Delete&id=" . $row['comment_id'] . "'
                          onclick='return confirm(\"" . lang("DELETE_COMMENT_CONFIRMATION") . "\")'
                          class='btn btn-danger control_field'> <i class='fa fa-trash'></i></a> ";
                if ($row['comment_status'] == 0) :
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
    elseif ($do == 'Edit') : // Edit Page 

      // Check If Get Request commentid Is Numeric & Get The Integer Value Of It
      $commentid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
      // Prepare The Statement To Execute It [1]
      $stmt = $connect->prepare('SELECT * FROM comments WHERE comment_id = ?');
      $stmt->execute([$commentid]); // Execute The Statement [2]
      $row = $stmt->fetch(); // Fetch The Data [3]
      $rowCount = $stmt->rowCount(); // Get The Count Of The Rows [4]

      if ($rowCount > 0) : ?>

        <div class="container edit-container">
          <h1><?= lang("EDIT_COMMENTS") ?></h1>
          <form action="?do=Update" method="POST">
            <input type="hidden" name="commentid" value="<?= $commentid ?>">
            <!-- Start Edit Comment -->
            <div class="mb-3">
              <label for="comment_content" class="form-label"><?= lang("EDIT_COMMENT") ?></label>
              <div class="input-wrapper">
                <input type="text" class="form-control" id="comment_content" name="comment_content" autocomplete="off" placeholder="<?= lang("EDIT_COMMENT_PLACDHODER") ?>" value="<?= $row['comment_content'] ?>" Required>
              </div>
            </div>
            <!-- End Edit Comment -->
            <!-- Start item -->
            <div class="mb-3">
              <label for="item" class="form-label"><?= lang("COMMENT_ITEM_MANAGE") ?></label>
              <select class="form-select" name="item" id="item">
                <?php
                $stmt = $connect->prepare('SELECT * FROM items');
                $stmt->execute();
                $items = $stmt->fetchAll();
                foreach ($items as $item) :
                  echo "<option value='" . $item['item_id'] . "'";
                  if ($row['item_connect'] == $item['item_id']) :
                    echo 'selected';
                  endif;
                  echo ">" . $item['item_name'] . "</option>";
                endforeach;
                ?>
              </select>
            </div>
            <!-- End item -->
            <!-- Start Member -->
            <div class="mb-3">
              <label for="member" class="form-label"><?= lang("COMMENT_USER_MANAGE") ?></label>
              <select class="form-select" name="member" id="member">
                <?php
                $stmt = $connect->prepare('SELECT * FROM users');
                $stmt->execute();
                $users = $stmt->fetchAll();
                foreach ($users as $user) :
                  echo "<option value='" . $user['user_id'] . "'";
                  if ($row['user_connect'] == $user['user_id']) :
                    echo 'selected';
                  endif;
                  echo ">" . $user['user_name'] . "</option>";
                endforeach;
                ?>
              </select>
            </div>
            <!-- End Member -->
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary  "> <i class='fa fa-edit'></i> <?= lang("UPDATE_BTN") ?></button>
          </form>
        </div>

  <?php
      else :
        redirectFuncError(lang("ID_NOT_FOUND_WARNING"), 'comments.php');
      endif;
    elseif ($do == 'Update') : // Update Page
      echo "<div class='container'>";

      if ($_SERVER['REQUEST_METHOD'] == 'POST') :
        echo "<h1>" . lang("UPDATE_COMMENT") . "</h1>";
        // Get The Variables From The Form
        $commentid = $_POST['commentid']; // The Id Sanitized In Line 190
        $comment_content = filter_input(INPUT_POST, 'comment_content', FILTER_SANITIZE_STRING);
        $item = filter_input(INPUT_POST, 'item', FILTER_SANITIZE_NUMBER_INT);
        $member = filter_input(INPUT_POST, 'member', FILTER_SANITIZE_NUMBER_INT);

        // Check Form Validation
        $formErrors = array();
        if (empty($comment_content)) :
          $formErrors[] = lang("COMMENT_CONTENT_EMPTY");
        endif;

        if (!empty($formErrors)) :
          redirectFuncError($formErrors, 'back', 5);
        else :
          // Get Old Data To Compare It With The New Data To Check If The User Change The Username Or Email, etc...
          $oldValues = $connect->prepare('SELECT * FROM comments WHERE comment_id = ?');
          $oldValues->execute(array($commentid));
          $oldData = $oldValues->fetch();

          // Create Array Contain Success Messages
          $successMessages = array();

          // Check If The Comment Is Updated
          if ($comment_content !== $oldData['comment_content']) :
            $successMessages[] = lang("UPDATE_COMMENT_SUCCESS");
          endif;

          // Check If The Item Is Updated
          if ($item != $oldData['item_connect']) :
            $successMessages[] = lang("COMMENT_UPDATE_ITEM_SUCCESS");
          endif;

          // Check If The Member Is Updated
          if ($member != $oldData['user_connect']) :
            $successMessages[] = lang("COMMENT_UPDATE_MEMBER_SUCCESS");
          endif;

          // Prepare The Update Query
          $stmt = $connect->prepare('UPDATE
                                      comments
                                    SET
                                      comment_content = ?, item_connect = ?, user_connect = ?
                                    WHERE
                                      comment_id = ?');
          // Execute The Query
          $stmt->execute(array($comment_content, $item, $member, $commentid));
          // Echo Success Message
          redirectFuncSuccess($successMessages, 'comments.php');

        endif;

      else :
        redirectFuncError(lang("DIRECT_LINK"), 'comments.php');
      endif;

    elseif ($do == 'Delete') : // Delete Page
      echo "<div class='container'>";
      // Check If Get Request commentid Is Numeric & Get The Integer Value Of It
      $commentid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;

      $check = checkItem('comment_id', 'comments', $commentid);

      if ($check > 0) :
        echo '<h1>' . lang("DELETE_COMMENT") . '</h1>';
        // Get The Username Of The User
        $username = getNameByCommentId($commentid);
        $stmt = $connect->prepare('DELETE FROM comments WHERE comment_id = ?'); // Prepare The Delete Query
        $stmt->execute(array($commentid)); // Execute The Query
        redirectFuncSuccess($username . ' ' . lang("DELETE_COMMENT_SUCCESS"), 'comments.php');
      else :
        redirectFuncError(lang("ID_NOT_FOUND_WARNING"), 'comments.php');
      endif;
      echo "</div>";
    elseif ($do == 'Approve') : // Approve Page
      // Check If Get Request commentid Is Numeric & Get The Integer Value Of It
      $commentid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;

      $check = checkItem('comment_id', 'comments', $commentid);

      if ($check > 0) :
        echo "<div class='container'>";
        echo '<h1>' . lang("ACTIVATE_MEMBER") . '</h1>';
        echo '</div>';

        // Get The User ID
        $stmt = $connect->prepare('UPDATE comments SET comment_status = 1 WHERE comment_id = ?'); // Prepare The Update Query
        $stmt->execute(array($commentid)); // Execute The Query
        redirectFuncSuccess(getNameByCommentId($commentid) . ' ' . lang("ACTIVATE_MEMBER_COMMENT_SUCCESS"), 'back');
      else :
        redirectFuncError(lang("ID_NOT_FOUND_WARNING"), 'comments.php');
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