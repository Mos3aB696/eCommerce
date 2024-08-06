<?php

/*
  ====================================================
  == Categories Page
  == You Can Add | Edit | Delete Categories From Here
  ====================================================
*/

ob_start(); // Output Buffering Start
session_start();
$pageTitle = 'Items';

if (isset($_SESSION['admin_name'])) :
  include 'init.php'; // Include The Init File

  $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
  // Start Manage Page
  if ($do == 'Manage') : // Manage Categories Page 

    // Define allowed columns and order directions
    $allowedColumns = ['item_id', 'item_name', 'item_description', 'item_price', 'add_date', 'category_connect', 'user_connect'];
    $allowedOrders = ['ASC', 'DESC'];

    // Sanitize and validate the input
    $sort_col = isset($_GET['sort_col']) ? $_GET['sort_col'] : 'item_id';
    $sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC';

    // Check if the input values are allowed
    if (!in_array($sort_col, $allowedColumns) || !in_array($sort_order, $allowedOrders)) {
      $sort_col = 'item_id';
      $sort_order = 'ASC';
    }
    $columnMap = [
      'user_connect' => 'users.user_name',
      'category_connect' => 'categories.cat_name'
    ];

    // Get column name from the map or use the original column name
    $actualSortColumn = $columnMap[$sort_col] ?? $sort_col;

    // Placehoders[?] Used For values Not Columns Names For Security [Prevent SQL Injection]
    // Get The Data From The Database
    $stmt = $connect->prepare("SELECT
                                    items.*,
                                    users.user_name,
                                    categories.cat_name
                                  FROM
                                    items
                                  INNER JOIN
                                    users
                                  ON
                                    users.user_id = items.user_connect
                                  INNER JOIN
                                    categories
                                  ON
                                    categories.cat_id = items.category_connect
                                  ORDER BY $actualSortColumn $sort_order");
    $stmt->execute();
    $rows = $stmt->fetchAll();
?>
    <div class="container cat-container">
      <h1><?= lang("MANAGE_ITEMS") ?></h1>

      <div class="container ">
        <!-- Start Sorting Form -->
        <form action="items.php" method='GET'>
          <div class="row mb-4">
            <div class="col-md-5">
              <select name="sort_col" class='form-select'>
                <option value="item_id" <?= ($sort_col == 'item_id') ? 'selected' : ''; ?>><?= lang('ITEM_ID') ?>
                </option>
                <option value="item_name" <?= ($sort_col == 'item_name') ? 'selected' : ''; ?>>
                  <?= lang('MANAGE_ITEM_NAME') ?>
                </option>
                <option value="user_connect" <?= ($sort_col == 'user_connect') ? 'selected' : ''; ?>>
                  <?= lang('MANAGE_ITEM_MEMBER') ?>
                </option>
                <option value="category_connect" <?= ($sort_col == 'category_connect') ? 'selected' : ''; ?>>
                  <?= lang('MANAGE_ITEM_CAT') ?>
                </option>
                <option value="item_description" <?= ($sort_col == 'item_description') ? 'selected' : ''; ?>>
                  <?= lang('MANAGE_ITEM_DESC') ?>
                </option>
                <option value="item_price" <?= ($sort_col == 'item_price') ? 'selected' : ''; ?>>
                  <?= lang('MANAGE_ITEM_PRICE') ?>
                </option>
                <option value="add_date" <?= ($sort_col == 'add_date') ? 'selected' : ''; ?>>
                  <?= lang('MANAGE_ITEM_DATE') ?>
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
                <td><?= lang("ITEM_ID") ?></td>
                <td><?= lang("MANAGE_ITEM_NAME") ?></td>
                <td><?= lang("MANAGE_ITEM_MEMBER") ?></td>
                <td><?= lang("MANAGE_ITEM_CAT") ?></td>
                <td><?= lang("MANAGE_ITEM_DESC") ?> </td>
                <td><?= lang("MANAGE_ITEM_PRICE") ?> </td>
                <td><?= lang("MANAGE_ITEM_DATE") ?> </td>
                <td><?= lang("MANAGE_ITEM_CONTROL") ?></td>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($rows as $row) :
                echo "<tr>";
                echo "<td>" . $row['item_id'] . "</td>";
                echo "<td>" . $row['item_name'] . "</td>";
                echo "<td>" . $row['user_name'] . "</td>";
                echo "<td>" . $row['cat_name'] . "</td>";
                echo "<td>" . $row['item_description'] . "</td>";
                echo "<td>$" . $row['item_price'] . "</td>";
                echo "<td>" . $row['add_date'] . "</td>";
                echo "<td>
                      <a href='?do=Edit&id=" . $row['item_id'] . "'
                        class='btn btn-success control_field'> <i class='fa fa-edit'></i> </a>
                      <a href='?do=Delete&id=" . $row['item_id'] . "'
                        onclick='return confirm(\"" . lang("DELETE_ITEM_CONFIRMATION") . "\")'
                        class='btn btn-danger control_field'> <i class='fa fa-trash'></i> </a> ";
                if ($row['item_approve'] == 0) :
                  echo "<a href='?do=Approve&id=" . $row['item_id'] . "'
                                      onclick='return confirm(\"" . lang("APPROVE_MEMBER_CONFIRMATION") . "\")'
                                      class='btn btn-info control_field'> <i class='fa fa-check'></i>  </a>";
                endif;
                echo "</td>";
                echo "</tr>";
              endforeach;
              ?>
            </tbody>
          </table>
        </div>
        <a href='?do=Add' class='btn btn-primary mb-5  '> <i class="fa fa-plus"> </i> <?= lang(("ADD_ITEM")) ?> </a>
      </div>
    <?php
  // End Manage Page
  elseif ($do == 'Add') : // Add Categories Page 
    ?>

      <div class="container add-container">
        <h1><?= lang('ADD_ITEMS_PAGE') ?></h1>
        <form action="?do=Insert" method='POST'>
          <div class="mb-3">
            <label class="form-label" for="member"><?= lang('CHOOSE_MEMBER') ?></label>
            <select class="form-select" name="member" id="member">
              <option value="0">...</option>
              <?php
              $stmt = $connect->prepare("SELECT * FROM users");
              $stmt->execute();
              $users = $stmt->fetchAll();
              foreach ($users as $user) :
                echo "<option value='" . $user['user_id'] . "'>" . $user['user_name'] . "</option>";
              endforeach;
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label" for="category"><?= lang('CHOOSE_CATEGORY') ?></label>
            <select class="form-select" name="category" id="category">
              <option value="0">...</option>
              <?php
              $stmt = $connect->prepare("SELECT * FROM categories");
              $stmt->execute();
              $cats = $stmt->fetchAll();
              foreach ($cats as $cat) :
                echo "<option value='" . $cat['cat_id'] . "'>" . $cat['cat_name'] . "</option>";
              endforeach;
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label" for="item-name"><?= lang('ITEM_NAME') ?></label>
            <div class="input-wrapper">
              <input type="text" class="form-control" id="item-name" name="item-name" required placeholder="<?= lang('ITEM_NAME_PLACEHOLDER') ?>">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="item-description"><?= lang('ITEM_DESCRIPTION') ?></label>
            <div class="input-wrapper">
              <input type="text" class="form-control" id="item-description" name="item-description" required placeholder="<?= lang('ITEM_DESC_PLACEHOLDER') ?>">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="item-price"><?= lang('ITEM_PRICE') ?></label>
            <div class="input-wrapper">
              <input type="text" class="form-control" id="item-price" name="item-price" required placeholder="<?= lang('ITEM_PRICE_PLACEHOLDER') ?>">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="item-country"><?= lang('ITEM_COUNTRY') ?></label>
            <div class="input-wrapper">
              <input type="text" class="form-control" id="item-country" name="item-country" required placeholder="<?= lang('ITEM_COUNTRY_PLACEHOLDER') ?>">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="item-status"><?= lang('ITEM_STATUS') ?></label>
            <select class="form-select" name="item-status" id="item-status">
              <option value="0">...</option>
              <option value="1"><?= lang("NEW_OPT") ?></option>
              <option value="2"><?= lang("LIKE_NEW_OPT") ?></option>
              <option value="3"><?= lang("USED_OPT") ?></option>
              <option value="4"><?= lang("OLD_OPT") ?></option>
            </select>
          </div>

          <button type="submit" class="btn btn-primary mb-5  "> <i class="fa fa-plus"></i>
            <?= lang('ADD_CAT_BTN') ?></button>
        </form>
      </div>
      <?php
    // End Add Page
    elseif ($do == 'Insert') : // Insert Categories Page
      echo '<div class="container">';
      // Check If The User Coming From A Request
      if ($_SERVER['REQUEST_METHOD'] == 'POST') :
        echo '<h1>' . lang('INSERT_ITEM') . '</h1>';
        // Get Variables From The Form And Filter Them
        $member = filter_input(INPUT_POST, 'member', FILTER_SANITIZE_NUMBER_INT);
        $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT);
        $itemName = filter_input(INPUT_POST, 'item-name', FILTER_SANITIZE_STRING);
        $itemDesc = filter_input(INPUT_POST, 'item-description', FILTER_SANITIZE_STRING);
        $itemPrice = filter_input(INPUT_POST, 'item-price', FILTER_SANITIZE_NUMBER_INT);
        $itemCountry = filter_input(INPUT_POST, 'item-country', FILTER_SANITIZE_STRING);
        $itemStatus = filter_input(INPUT_POST, 'item-status', FILTER_SANITIZE_NUMBER_INT);

        $formErrors = array();

        if ($member == 0) :
          $formErrors[] = lang('MEMBER_EMPTY');
        endif;
        if ($category == 0) :
          $formErrors[] = lang('CATEGORY_EMPTY');
        endif;
        if (empty($itemName)) :
          $formErrors[] = lang('ITEM_NAME_EMPTY');
        elseif (strlen($itemName) < 4) :
          $formErrors[] = lang('ITEM_NAME_LESS');
        elseif (strlen($itemName) > 30) :
          $formErrors[] = lang('ITEM_NAME_MORE');
        endif;
        if (empty($itemDesc)) :
          $formErrors[] = lang('ITEM_DESC_EMPTY');
        endif;
        if (empty($itemPrice)) :
          $formErrors[] = lang('ITEM_PRICE_EMPTY');
        endif;
        if (empty($itemCountry)) :
          $formErrors[] = lang('ITEM_COUNTRY_EMPTY');
        endif;
        if ($itemStatus == 0) :
          $formErrors[] = lang('ITEM_STATUS_EMPTY');
        endif;

        if (!empty($formErrors)) :
          redirectFuncError($formErrors, 'back');
        else :
          // Prepare The Insert Query
          $stmt = $connect->prepare("INSERT INTO items
                  (item_name, item_description, item_price, country_made, item_status, add_date, category_connect, user_connect)
                                    VALUES
                  (:zname, :zdesc, :zprice, :zcountry, :zstatus, now(), :zcat, :zuser)");
          // Execute The Query
          $stmt->execute(
            array(
              'zname' => $itemName,
              'zdesc' => $itemDesc,
              'zprice' => $itemPrice,
              'zcountry' => $itemCountry,
              'zstatus' => $itemStatus,
              'zcat' => $category,
              'zuser' => $member
            )
          );
          redirectFuncSuccess($itemName . ' ' . lang('INSERT_ITEM_SUCCESS'), 'items.php');
        endif;

      else :
        redirectFuncError(lang('DIRECT_LINK'));
      endif;
      echo '</div>';
    elseif ($do == 'Edit') : // Edit Categories Page

      // Check If Get Request itemid Is Numeric & Get The Integer Value Of It
      $itemid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
      // Prepare The Statement To Execute It [1]
      $stmt = $connect->prepare('SELECT * FROM items WHERE item_id = ?');
      $stmt->execute(array($itemid)); // Execute The Statement [2]
      $item = $stmt->fetch(); // Fetch The Data [3]
      $rowCount = $stmt->rowCount(); // Get The Count Of The Rows [4]

      if ($rowCount > 0) : ?>

        <div class="container add-container">
          <h1><?= lang("EDIT_ITEM") ?></h1>
          <form action="?do=Update" method='POST'>
            <input type="hidden" name="itemid" value="<?= $itemid ?>">
            <div class="mb-3">
              <label class="form-label" for="member"><?= lang('CHOOSE_MEMBER') ?></label>
              <select class="form-select" name="member" id="member">
                <?php
                $stmt = $connect->prepare("SELECT * FROM users");
                $stmt->execute();
                $users = $stmt->fetchAll();
                foreach ($users as $user) :
                  echo "<option value='" . $user['user_id'] . "'";
                  if ($item['user_connect'] == $user['user_id']) :
                    echo " selected";
                  endif;
                  echo ">" . $user['user_name'] . "</option>";
                endforeach;
                ?>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label" for="category"><?= lang('CHOOSE_CATEGORY') ?></label>
              <select class="form-select" name="category" id="category">
                <option value="0">...</option>
                <?php
                $stmt = $connect->prepare("SELECT * FROM categories");
                $stmt->execute();
                $cats = $stmt->fetchAll();
                foreach ($cats as $cat) :
                  echo "<option value='" . $cat['cat_id'] . "'";
                  if ($item['category_connect'] == $cat['cat_id']) :
                    echo " selected";
                  endif;
                  echo ">" . $cat['cat_name'] . "</option>";
                endforeach;
                ?>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label" for="item-name"><?= lang('ITEM_NAME') ?></label>
              <div class="input-wrapper">
                <input type="text" class="form-control" id="item-name" name="item-name" required placeholder="<?= lang('ITEM_NAME_PLACEHOLDER') ?>" value="<?= $item['item_name'] ?>">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label" for="item-description"><?= lang('ITEM_DESCRIPTION') ?></label>
              <div class="input-wrapper">
                <input type="text" class="form-control" id="item-description" name="item-description" required placeholder="<?= lang('ITEM_DESC_PLACEHOLDER') ?>" value="<?= $item['item_description'] ?>">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label" for="item-price"><?= lang('ITEM_PRICE') ?></label>
              <div class="input-wrapper">
                <input type="text" class="form-control" id="item-price" name="item-price" required placeholder="<?= lang('ITEM_PRICE_PLACEHOLDER') ?>" value="<?= $item['item_price'] ?>">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label" for="item-country"><?= lang('ITEM_COUNTRY') ?></label>
              <div class="input-wrapper">
                <input type="text" class="form-control" id="item-country" name="item-country" required placeholder="<?= lang('ITEM_COUNTRY_PLACEHOLDER') ?>" value="<?= $item['country_made'] ?>">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label" for="item-status"><?= lang('ITEM_STATUS') ?></label>
              <select class="form-select" name="item-status" id="item-status">
                <option value="1" <?= ($item['item_status'] == 1) ? "selected" : ''; ?>> <?= lang("NEW_OPT") ?></option>
                <option value="2" <?= ($item['item_status'] == 2) ? "selected" : ''; ?>> <?= lang("LIKE_NEW_OPT") ?></option>
                <option value="3" <?= ($item['item_status'] == 3) ? "selected" : ''; ?>> <?= lang("USED_OPT") ?></option>
                <option value="4" <?= ($item['item_status'] == 4) ? "selected" : ''; ?>> <?= lang("OLD_OPT") ?></option>
              </select>
            </div>

            <button type="submit" class="btn btn-primary mb-5  "> <i class="fa fa-edit"></i>
              <?= lang('UPDATE_BTN') ?></button>
          </form>
          <?php
          // Get The Data From The Database
          $stmt = $connect->prepare("SELECT
                                        comments.*,
                                        users.user_name
                                      FROM
                                        comments
                                      INNER JOIN
                                        users
                                      ON
                                        comments.user_connect = users.user_id
                                      WHERE
                                        item_connect = ?");
          $stmt->execute(array($itemid));
          $rows = $stmt->fetchAll();

          if (!empty($rows)) :
          ?>
            <h2> <?= $item['item_name'] ?> </h2>
            <div class="table-responsive mb-5">
              <table class="main-table text-center table table-striped table-hover table-bordered">
                <thead>
                  <tr>
                    <td><?= lang("COMMENT_CONTENT_MANAGE") ?></td>
                    <td><?= lang("COMMENT_USER_MANAGE") ?></td>
                    <td><?= lang("CONTROL_MANAGE") ?></td>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($rows as $row) :
                    echo "<tr>";
                    echo "<td>" . $row['comment_content'] . "</td>";
                    echo "<td>" . $row['user_name'] . "</td>";
                    echo "<td>
                        <a href='comments.php?do=Edit&id=" . $row['comment_id'] . "' class='btn btn-success control_field'> <i class='fa fa-edit'></i> </a>
                        <a href='comments.php?do=Delete&id=" . $row['comment_id'] . "'
                          onclick='return confirm(\"" . lang("DELETE_COMMENT_CONFIRMATION") . "\")'
                          class='btn btn-danger control_field'> <i class='fa fa-trash'></i></a> ";
                    if ($row['comment_status'] == 0) :
                      echo "<a href='comments.php?do=Approve&id=" . $row['comment_id'] . "'
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
          <?php endif; ?>
        </div>
  <?php
      else :
        redirectFuncError(lang("ID_NOT_FOUND_WARNING"), 'items.php');
      endif;
    // End Edit Page
    elseif ($do == 'Update') : // Update Categories Page
      echo "<div class='container'>";
      if ($_SERVER['REQUEST_METHOD'] == 'POST') :
        echo "<h1>" . lang("UPDATE_ITEM") . "</h1>";
        // Get Variables From The Form And Filter Them
        $itemid = filter_input(INPUT_POST, 'itemid', FILTER_SANITIZE_NUMBER_INT);
        $member = filter_input(INPUT_POST, 'member', FILTER_SANITIZE_NUMBER_INT);
        $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT);
        $itemName = filter_input(INPUT_POST, 'item-name', FILTER_SANITIZE_STRING);
        $itemDesc = filter_input(INPUT_POST, 'item-description', FILTER_SANITIZE_STRING);
        $itemPrice = filter_input(INPUT_POST, 'item-price', FILTER_SANITIZE_NUMBER_INT);
        $itemCountry = filter_input(INPUT_POST, 'item-country', FILTER_SANITIZE_STRING);
        $itemStatus = filter_input(INPUT_POST, 'item-status', FILTER_SANITIZE_NUMBER_INT);

        $formErrors = array();

        if ($member == 0) :
          $formErrors[] = lang('MEMBER_EMPTY');
        endif;
        if ($category == 0) :
          $formErrors[] = lang('CATEGORY_EMPTY');
        endif;
        if (empty($itemName)) :
          $formErrors[] = lang('ITEM_NAME_EMPTY');
        elseif (strlen($itemName) < 4) :
          $formErrors[] = lang('ITEM_NAME_LESS');
        elseif (strlen($itemName) > 30) :
          $formErrors[] = lang('ITEM_NAME_MORE');
        endif;
        if (empty($itemDesc)) :
          $formErrors[] = lang('ITEM_DESC_EMPTY');
        endif;
        if (empty($itemPrice)) :
          $formErrors[] = lang('ITEM_PRICE_EMPTY');
        endif;
        if (empty($itemCountry)) :
          $formErrors[] = lang('ITEM_COUNTRY_EMPTY');
        endif;
        if ($itemStatus == 0) :
          $formErrors[] = lang('ITEM_STATUS_EMPTY');
        endif;

        if (!empty($formErrors)) :
          redirectFuncError($formErrors, 'back', 5);
        else :
          // Get Old Data To Compare It With The New Data To Check If The User Change The Username Or Email, etc...
          $oldValues = $connect->prepare('SELECT * FROM items WHERE item_id = ?');
          $oldValues->execute(array($itemid));
          $oldData = $oldValues->fetch();

          // Create Array Contain Success Messages
          $successMessages = array();
          // Check If The Member Is Updated
          if ($member != $oldData['user_connect']) :
            $successMessages[] = lang("UPDATE_MEMBER_SUCCESS");
          endif;

          if ($category != $oldData['category_connect']) :
            $successMessages[] = lang("UPDATE_CATEGORY_SUCCESS");
          endif;

          if ($itemName !== $oldData['item_name']) :
            $successMessages[] = lang("UPDATE_ITEM_NAME_SUCCESS");
          endif;

          if ($itemDesc !== $oldData['item_description']) :
            $successMessages[] = lang("UPDATE_DESCRIPTION_SUCCESS");
          endif;

          if ($itemPrice != $oldData['item_price']) :
            $successMessages[] = lang("UPDATE_PRICE_SUCCESS");
          endif;

          if ($itemCountry !== $oldData['country_made']) :
            $successMessages[] = lang("UPDATE_COUNTRY_SUCCESS");
          endif;

          if ($itemStatus !== $oldData['item_status']) :
            $successMessages[] = lang("UPDATE_STATUS_SUCCESS");
          endif;

          // Prepare The Update Query
          $stmt = $connect->prepare('UPDATE
                                    items
                                  SET 
                                    item_name = ?,
                                    item_description = ?,
                                    item_price = ?,
                                    country_made = ?,
                                    item_status = ?,
                                    category_connect = ?,
                                    user_connect = ?
                                  WHERE 
                                    item_id = ?');
          // Execute The Query
          $stmt->execute(array($itemName, $itemDesc, $itemPrice, $itemCountry, $itemStatus, $category, $member, $itemid));
          // Echo Success Message
          redirectFuncSuccess($successMessages, 'items.php', 5);
        endif;

      else :
        redirectFuncError(lang("DIRECT_LINK"), 'members.php', 5);
      endif;
    // End Update Page
    elseif ($do == 'Delete') : // Delete Categories Page

      echo "<div class='container'>";
      // Check If Get Request itemid Is Numeric & Get The Integer Value Of It
      $itemid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;

      $check = checkItem('item_id', 'items', $itemid);

      if ($check > 0) :
        echo '<h1>' . lang("DELETE_ITEM") . '</h1>';
        // Get The Username Of The User
        $itemName = getName('item_name', 'items', 'item_id', $itemid);
        $stmt = $connect->prepare('DELETE FROM items WHERE item_id = ?'); // Prepare The Delete Query
        $stmt->execute(array($itemid)); // Execute The Query
        redirectFuncSuccess($itemName . ' ' . lang("DELETE_MEMBER_SUCCESS"), 'items.php');
      else :
        redirectFuncError(lang("ID_NOT_FOUND_WARNING"));
      endif;
      echo "</div>";


    // End Delete Page
    elseif ($do == 'Approve') : // Approve Categories Page
      // Check If Get Request itemid Is Numeric & Get The Integer Value Of It
      $itemid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;

      $check = checkItem('item_id', 'items', $itemid);

      if ($check > 0) :
        echo "<div class='container'>";
        echo '<h1>' . lang("APPROVE_ITEM") . '</h1>';
        // Get The User ID
        $stmt = $connect->prepare('UPDATE items SET item_approve = 1 WHERE item_id = ?'); // Prepare The Update Query
        $stmt->execute(array($itemid)); // Execute The Query
        redirectFuncSuccess(getName('item_name', 'items', 'item_id', $itemid) . ' ' . lang("APPROVE_ITEM_SUCCESS"), 'back');
      else :
        redirectFuncError(lang("ID_NOT_FOUND_WARNING"));
        echo '</div>';
      endif;
    endif;


    include $temp . 'footer.php'; // Include The Footer File
  else :
    header('Location: index.php'); // Redirect To Index Page
    exit();
  endif;

  ob_end_flush(); // Release The Output
