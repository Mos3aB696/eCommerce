<?php

/*
  ====================================================
  == Categories Page
  == You Can Add | Edit | Delete Categories From Here
  ====================================================
*/

ob_start(); // Output Buffering Start
session_start();
$pageTitle = 'Categories';

if (isset($_SESSION['admin_name'])) :
  include 'init.php'; // Include The Init File

  $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';


  // Start Manage Page
  if ($do == 'Manage') : // Manage Categories Page 

    // Define allowed columns and order directions
    $allowedColumns = ['cat_id', 'cat_name', 'cat_description', 'ordering', 'visibility', 'allow_comment', 'allow_ads'];
    $allowedOrders = ['ASC', 'DESC'];

    // Sanitize and validate the input
    $sort_col = isset($_GET['sort_col']) ? $_GET['sort_col'] : 'cat_id';
    $sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC';

    // Check if the input values are allowed
    if (!in_array($sort_col, $allowedColumns) || !in_array($sort_order, $allowedOrders)) {
      $sort_col = 'cat_id';
      $sort_order = 'ASC';
    }
    // Placehoders[?] Used For values Not Columns Names For Security [Prevent SQL Injection]
    $stmt = $connect->prepare("SELECT * FROM categories ORDER BY $sort_col $sort_order");
    $stmt->execute();
    $rows = $stmt->fetchAll();
?>
    <div class="container cat-container">
      <h1><?= lang("MANAGE_CAT") ?></h1>
      <div class="container ">
        <!-- Start Sorting Form -->
        <form action="categories.php" method='GET'>
          <div class="row mb-4">
            <div class="col-md-5">
              <select name="sort_col" class='form-select'>
                <option value="cat_id" <?= ($sort_col == 'cat_id') ? 'selected' : ''; ?>><?= lang('MANAGE_CAT_ID') ?>
                </option>
                <option value="cat_name" <?= ($sort_col == 'cat_name') ? 'selected' : ''; ?>>
                  <?= lang('MANAGE_CAT_NAME') ?>
                </option>
                <option value="cat_description" <?= ($sort_col == 'cat_description') ? 'selected' : ''; ?>>
                  <?= lang('MANAGE_CAT_DESC') ?>
                </option>
                <option value="ordering" <?= ($sort_col == 'ordering') ? 'selected' : ''; ?>>
                  <?= lang('MANAGE_CAT_ORDER') ?>
                </option>
                <option value="visibility" <?= ($sort_col == 'visibility') ? 'selected' : ''; ?>>
                  <?= lang('MANAGE_CAT_VISABLE') ?>
                </option>
                <option value="allow_comment" <?= ($sort_col == 'allow_comment') ? 'selected' : ''; ?>>
                  <?= lang('MANAGE_CAT_COMMENT') ?>
                </option>
                <option value="allow_ads" <?= ($sort_col == 'allow_ads') ? 'selected' : ''; ?>>
                  <?= lang('MANAGE_CAT_ADS') ?>
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
      <div class="table-responsive">
        <table class="table main-table table-bordered text-center table-striped table-hover">
          <thead>
            <tr>
              <td><?= lang('MANAGE_CAT_ID') ?></td>
              <td><?= lang('MANAGE_CAT_NAME') ?></td>
              <td><?= lang('MANAGE_CAT_DESC') ?></td>
              <td><?= lang('MANAGE_CAT_ORDER') ?></td>
              <td><?= lang('MANAGE_CAT_VISABLE') ?></td>
              <td><?= lang('MANAGE_CAT_COMMENT') ?></td>
              <td><?= lang('MANAGE_CAT_ADS') ?></td>
              <td><?= lang('MANAGE_CONTROL_CAT') ?></td>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($rows as $row) :
              echo '<tr>';
              echo '<th scope="row">' . $row['cat_id'] . '</th>';
              echo '<td>' . $row['cat_name'] . '</td>';
              echo '<td class="category-description">' . $row['cat_description'] . '</td>';
              echo ($row['ordering'] == NULL ?
                '<td><span class="order-unset" >' . lang('NO_ORDER') . '</span></td>'
                : '<td>' . $row['ordering'] . '</td>');
              echo ($row['visibility'] == 0 ?
                '<td><span class="cat-on">' . lang("VISIBILITY_ON") . '</span></td>'
                : '<td><span class="cat-off">' . lang("VISIBILITY_OFF") . '</span></td>');
              echo ($row['allow_comment'] == 0 ?
                '<td class="cat-on"><span class="cat-on">' . lang("COMMENT_ON") . '</span></td>'
                : '<td><span class="cat-off">' . lang("COMMENT_OFF") . '</span></td>');
              echo ($row['allow_ads'] == 0 ?
                '<td class="cat-on"><span class="cat-on">' . lang("ADS_ON") . '</span></td>'
                : '<td><span class="cat-off">' . lang("ADS_OFF") . '</span></td>');
              echo '<td>
                    <a href="categories.php?do=Edit&id=' . $row['cat_id'] .
                '" class="btn btn-success"> <i class="fa fa-edit"></i> </a>
                    <a href="categories.php?do=Delete&id=' . $row['cat_id'] .
                '" class="btn btn-danger"
                onclick="return confirm(\'' . lang('DELETE_CAT_CONFIRMATION') . '\')"
                > <i class="fa fa-trash"></i> </a>
                  </td>';
              echo '</tr>';
            endforeach;
            ?>
          </tbody>
        </table>
      </div>
      <a href="?do=Add" class='btn btn-primary '><i class='fa fa-plus'></i> <?= lang("ADD_CATEGORY") ?></a>
    </div>


  <?php
  // End Manage Page
  elseif ($do == 'Add') : // Add Categories Page 
  ?>

    <div class="container add-container">
      <h1><?= lang('ADD_CAT_PAGE') ?></h1>
      <form action="categories.php?do=Insert" method='POST'>
        <div class="mb-3">
          <label class="form-label" for="category-name"><?= lang('CAT_NAME') ?></label>
          <div class="input-wrapper">
            <input type="text" class="form-control" id="category-name" name="category-name" placeholder="<?= lang('CAT_NAME_PLACEHOLDER') ?>" required>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label" for="category-description"><?= lang('CAT_DESCRIPTION') ?></label>
          <div class="input-wrapper">
            <input type="text" class="form-control" id="category-description" name="category-description" placeholder="<?= lang('CAT_DESC_PLACEHOLDER') ?>" required>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label" for="category-order"><?= lang('CAT_ORDER') ?></label>
          <div class="input-wrapper">
            <input type="number" class="form-control" id="category-order" name="category-order" placeholder="<?= lang('CAT_ORDER_PLACEHOLDER') ?>">
          </div>
        </div>
        <div class="mb-3">
          <label for="category-visable" class='form-label'> <?= lang("CAT_VISABLE") ?> </label>
          <select class="form-select" id="category-visable" name="category-visable">
            <option value="0" selected> <?= lang("VIS_YES") ?> </option>
            <option value="1"> <?= lang("VIS_NO") ?> </option>
          </select>
        </div>
        <div class="mb-3">
          <label for="category-comment" class='form-label'> <?= lang("CAT_COMMENT") ?> </label>
          <select class="form-select" id="category-comment" name="category-comment">
            <option value="0" selected> <?= lang("COM_YES") ?> </option>
            <option value="1"> <?= lang("COM_NO") ?> </option>
          </select>
        </div>
        <div class="mb-3">
          <label for="category-ads" class='form-label'> <?= lang("CAT_ADS") ?> </label>
          <select class="form-select" id="category-ads" name="category-ads">
            <option value="0" selected> <?= lang("ADS_YES") ?> </option>
            <option value="1"> <?= lang("ADS_NO") ?> </option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary  "> <i class="fa fa-plus"></i> <?= lang('ADD_CAT_BTN') ?></button>
      </form>
    </div>
    <?php
  // End Add Page
  elseif ($do == 'Insert') : // Insert Categories Page

    echo "<div class='container'>";
    // Check If The User Coming From A Request
    if ($_SERVER['REQUEST_METHOD'] == 'POST') :
      echo '<h1>' . lang('INSERT_CAT') . '</h1>';

      // Get Variables From The Form
      $categoryName = filter_input(INPUT_POST, 'category-name', FILTER_SANITIZE_STRING);
      $categoryDesc = filter_input(INPUT_POST, 'category-description', FILTER_SANITIZE_STRING);
      $categoryOrder = filter_input(INPUT_POST, 'category-order', FILTER_SANITIZE_NUMBER_INT);
      $categoryVisable = filter_input(INPUT_POST, 'category-visable', FILTER_SANITIZE_NUMBER_INT);
      $categoryComment = filter_input(INPUT_POST, 'category-comment', FILTER_SANITIZE_NUMBER_INT);
      $categoryAds = filter_input(INPUT_POST, 'category-ads', FILTER_SANITIZE_NUMBER_INT);

      // Check If Category Name Is Exist In Database Or Not
      $formErrors = array();
      $check = checkItem('cat_name', 'categories', $categoryName);

      // Check Data Validation
      if (empty($categoryName)) :
        $formErrors[] = lang("CAT_NAME_EMPTY");
      elseif (strlen($categoryName) < 4) :
        $formErrors[] = lang("CAT_NAME_LESS");
      elseif (strlen($categoryName) > 30) :
        $formErrors[] = lang("CAT_NAME_MORE");
      endif;
      if ($check > 0) :
        $formErrors[] = lang("CAT_EXISTS");
      endif;
      if (empty($categoryDesc)) :
        $formErrors[] = lang("CAT_DESC_EMPTY");
      endif;


      if (!empty($formErrors)) :
        redirectFuncError($formErrors, 'back', 5);
      else :
        // Check If Category Order Is Empty
        if ($categoryOrder == '') {
          $categoryOrder = NULL;
        }

        // Insert Category Info In Database
        $stmt = $connect->prepare("INSERT INTO 
                                        categories(cat_name, cat_description, ordering, visibility, allow_comment, allow_ads)
                                    VALUES
                                        (? , ?, ?, ?, ?, ?)");
        $stmt->execute(array($categoryName, $categoryDesc, $categoryOrder, $categoryVisable, $categoryComment, $categoryAds));

        // Echo Success Message
        redirectFuncSuccess($categoryName . ' ' . lang('INSERT_CAT_SUCCESS'), 'categories.php');
      endif;
    endif;
    // End Insert Page
    echo "</div>";
  elseif ($do == 'Edit') : // Edit Categories Page

    // Check If Get Request catid Is Numeric & Get The Integer Value Of It
    $catId = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;

    $stmt = $connect->prepare("SELECT * FROM categories WHERE cat_id = ?");
    $stmt->execute(array($catId));
    $row = $stmt->fetch();
    $rowCount = $stmt->rowCount();
    if ($rowCount > 0) : ?>

      <div class="container edit-container">
        <h1><?= lang("EDIT_CAT") ?></h1>
        <form action="?do=Update" method='POST'>
          <input type="hidden" name="catid" value="<?= $catId ?>">
          <div class="mb-3">
            <label class="form-label" for="category-name"><?= lang('CAT_NAME') ?></label>
            <div class="input-wrapper">
              <input type="text" class="form-control" id="category-name" name="category-name" value="<?= $row['cat_name'] ?>" required autocomplete='off' placeholder='<?= lang("CAT_NAME_PLACEHOLDER") ?>'>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="category-description"><?= lang('CAT_DESCRIPTION') ?></label>
            <div class="input-wrapper">
              <input type="text" class="form-control" id="category-description" name="category-description" value="<?= $row['cat_description'] ?>" required autocomplete='off' placeholder="<?= lang("CAT_DESC_PLACEHOLDER") ?>">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="category-order"><?= lang('CAT_ORDER') ?></label>
            <div class="input-wrapper">
              <input type="number" class="form-control" id="category-order" name="category-order" value="<?= $row['ordering'] ?>" placeholder="<?= lang('CAT_ORDER_PLACEHOLDER') ?>">
            </div>
          </div>
          <div class="mb-3">
            <label for="category-visibility" class='form-label'><?= lang('CAT_VISABLE') ?></label>
            <select class="form-select" name="category-visable" id="category-visibility">
              <option value="0" <?= ($row['visibility'] == 0) ? 'selected' : ''; ?>><?= lang('VIS_YES') ?></option>
              <option value="1" <?= ($row['visibility'] == 1) ? 'selected' : ''; ?>><?= lang('VIS_NO') ?></option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label" for="category-comment"><?= lang("CAT_COMMENT") ?></label>
            <select class="form-select" name="category-comment" id="category-comment">
              <option value="0" <?= ($row['allow_comment'] == 0) ? 'selected' : ''; ?>><?= lang("COM_YES") ?></option>
              <option value="1" <?= ($row['allow_comment'] == 1) ? 'selected' : ''; ?>><?= lang("COM_NO") ?></option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label" for="category-ads"><?= lang('CAT_ADS') ?></label>
            <select class="form-select" name="category-ads" id="category-ads">
              <option value="0" <?= ($row['allow_ads'] == 0) ? 'selected' : ''; ?>><?= lang('ADS_YES') ?></option>
              <option value="1" <?= ($row['allow_ads'] == 1) ? 'selected' : ''; ?>><?= lang("ADS_NO") ?></option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary  "><i class='fa fa-edit'></i> <?= lang("UPDATE_BTN") ?> </button>
        </form>
      </div>

<?php
    else :
      redirectFuncError(lang("ID_NOT_FOUND_WARNING"));
    endif;

  // End Edit Page
  elseif ($do == 'Update') : // Update Categories Page
    echo '<div class="container">';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') :
      echo '<h1>' . lang("UPDATE_CAT_PAGE") . '</h1>';
      // Get The Variables Values
      $catId = filter_input(INPUT_POST, 'catid', FILTER_SANITIZE_NUMBER_INT); // Filtered Above Line 217
      $catName = filter_input(INPUT_POST, 'category-name', FILTER_SANITIZE_STRING);
      $catDescription = filter_input(INPUT_POST, 'category-description', FILTER_SANITIZE_STRING);
      $catOrder = filter_input(INPUT_POST, 'category-order', FILTER_SANITIZE_NUMBER_INT);
      $catVisibility = filter_input(INPUT_POST, 'category-visable', FILTER_SANITIZE_NUMBER_INT);
      $catComment = filter_input(INPUT_POST, 'category-comment', FILTER_SANITIZE_NUMBER_INT);
      $catAds = filter_input(INPUT_POST, 'category-ads', FILTER_SANITIZE_NUMBER_INT);

      if ($catOrder == '') {
        $catOrder = NULL;
      }
      // Check Data Validation
      $formErrors = array();
      $check = editCheck('cat_name', 'categories', $catName, 'cat_id', $catId);
      if (empty($catName)) :
        $formErrors[] = lang("CAT_NAME_EMPTY");
      elseif ($check > 0) :
        $formErrors[] = lang("CAT_EXISTS");
      elseif (strlen($catName) < 4) :
        $formErrors[] = lang("CAT_NAME_LESS");
      elseif (strlen($catName) > 30) :
        $formErrors[] = lang("CAT_NAME_MORE");
      endif;
      if (empty($catDescription)) :
        $formErrors[] = lang("CAT_DESC_EMPTY");
      endif;


      if (!empty($formErrors)) :
        redirectFuncError($formErrors, 'back');
      else :

        // Get Old Values From Database
        $stmt = $connect->prepare("SELECT * FROM categories WHERE cat_id = ?");
        $stmt->execute(array($catId));
        $oldData = $stmt->fetch();

        // To Store Changes
        $successMsg = array();

        // Check The Changes
        if ($catName !== $oldData['cat_name']) :
          $successMsg[] = lang('UPDATE_CAT_NAME');
        endif;
        if ($catDescription !== $oldData['cat_description']) :
          $successMsg[] = lang('UPDATE_CAT_DESC');
        endif;
        if ($catOrder != $oldData['ordering']) :
          $successMsg[] = lang('UPDATE_CAT_ORDER');
        endif;
        if ($catVisibility != $oldData['visibility']) :
          $successMsg[] = lang("UPDATE_CAT_VISIBILITY");
        endif;
        if ($catComment != $oldData['allow_comment']) :
          $successMsg[] = lang("UPDATE_CAT_COMMENT");
        endif;
        if ($catAds != $oldData['allow_ads']) :
          $successMsg[] = lang('UPDATE_CAT_ADS');
        endif;

        // Prepare The Query To Execute
        $stmt = $connect->prepare("UPDATE categories SET
                                                    cat_name = ?,
                                                    cat_description = ?,
                                                    ordering = ?,
                                                    visibility = ?,
                                                    allow_comment = ?,
                                                    allow_ads = ?
                                                    WHERE cat_id = ?");

        $stmt->execute(
          array(
            $catName,
            $catDescription,
            $catOrder,
            $catVisibility,
            $catComment,
            $catAds,
            $catId
          )
        );

        redirectFuncSuccess($successMsg, 'categories.php');

      endif;

    else :
      redirectFuncError(lang('DIRECT_LINK'), 'back');
    endif;
    echo '</div>';
  // End Update Page
  elseif ($do == 'Delete') : // Delete Categories Page

    echo '<div class="container">';
    $catId = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
    $check = checkItem('cat_id', 'categories', $catId);

    if ($check > 0) :
      echo '<h1>' . lang('DELETE_CAT') . '</h1>';
      $stmt = $connect->prepare('DELETE FROM categories WHERE cat_id = ?');
      $stmt->execute(array($catId));
      redirectFuncSuccess(getName("cat_name", "categories", "cat_id", $catId) . ' ' . lang('DELETE_CAT_SUCCESS'), 'categories.php');
    else :
      redirectFuncError(lang('ID_NOT_FOUND_WARNING'));
    endif;
    echo '</div>';

  // End Delete Page
  endif;


  include $temp . 'footer.php'; // Include The Footer File
else :
  header('Location: index.php'); // Redirect To Index Page
  exit();
endif;

ob_end_flush(); // Release The Output
