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

if (isset($_SESSION['user_name'])):
  include 'init.php'; // Include The Init File

  $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';


  // Start Manage Page
  if ($do == 'Manage'): // Manage Categories Page 

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
      <h1><?php echo lang("MANAGE_CAT") ?></h1>
      <table class="table main-table table-bordered text-center">
        <div class="container ">
          <!-- Start Sorting Form -->
          <form action="categories.php" method='GET'>
            <div class="row mb-4">
              <div class="col-md-5">
                <select name="sort_col" class='form-select'>
                  <option value="cat_id" <?php echo ($sort_col == 'cat_id') ? 'selected' : ''; ?>>ID</option>
                  <option value="cat_name" <?php echo ($sort_col == 'cat_name') ? 'selected' : ''; ?>>Name</option>
                  <option value="cat_description" <?php echo ($sort_col == 'cat_description') ? 'selected' : ''; ?>>
                    Description
                  </option>
                  <option value="ordering" <?php echo ($sort_col == 'ordering') ? 'selected' : ''; ?>>Order</option>
                  <option value="visibility" <?php echo ($sort_col == 'visibility') ? 'selected' : ''; ?>>Visibility</option>
                  <option value="allow_comment" <?php echo ($sort_col == 'allow_comment') ? 'selected' : ''; ?>>Comment
                  </option>
                  <option value="allow_ads" <?php echo ($sort_col == 'allow_ads') ? 'selected' : ''; ?>>Ads</option>
                </select>
              </div>
              <div class="col-md-5">
                <select name="sort_order" class="form-select">
                  <option value="ASC" <?php echo ($sort_order == 'ASC') ? 'selected' : ''; ?>>ASC</option>
                  <option value="DESC" <?php echo ($sort_order == 'DESC') ? 'selected' : ''; ?>>DESC</option>
                </select>
              </div>
              <div class="col-md-2 custom-btn">
                <button type="submit" class="btn btn-primary">Sort</button>
              </div>
            </div>
          </form>
          <!-- End Sorting Form -->
        </div>

        <thead>
          <tr>
            <td>ID</td>
            <td><?php echo lang('MANAGE_CAT_NAME') ?></td>
            <td><?php echo lang('MANAGE_CAT_DESC') ?></td>
            <td><?php echo lang('MANAGE_CAT_ORDER') ?></td>
            <td><?php echo lang('MANAGE_CAT_VISABLE') ?></td>
            <td><?php echo lang('MANAGE_CAT_COMMENT') ?></td>
            <td><?php echo lang('MANAGE_CAT_ADS') ?></td>
            <td><?php echo lang('MANAGE_CONTROL_CAT') ?></td>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($rows as $row):
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
            echo ($row['visibility'] == 0 ?
              '<td class="cat-on"><span class="cat-on">' . lang("COMMENT_ON") . '</span></td>'
              : '<td><span class="cat-off">' . lang("COMMENT_OFF") . '</span></td>');
            echo ($row['visibility'] == 0 ?
              '<td class="cat-on"><span class="cat-on">' . lang("ADS_ON") . '</span></td>'
              : '<td><span class="cat-off">' . lang("ADS_OFF") . '</span></td>');
            echo '<td>
                    <a href="categories.php?do=Edit&catid=' . $row['cat_id'] .
              '" class="btn btn-success"> <i class="fa fa-edit"></i> ' . lang('EDIT_BTN') . '</a>
                    <a href="categories.php?do=Delete&catid=' . $row['cat_id'] .
              '" class="btn btn-danger confirm"> <i class="fa fa-trash"></i> ' . lang('DELETE_BTN') . '</a>
                  </td>';
            echo '</tr>';
          endforeach;
          ?>
    </div>


    <?php
    // End Manage Page
  elseif ($do == 'Add'): // Add Categories Page ?>

    <div class="container add-container">
      <h1><?php echo lang('ADD_CAT_PAGE') ?></h1>
      <form action="categories.php?do=Insert" method='POST'>
        <div class="mb-3">
          <label class="form-label" for="category-name"><?php echo lang('CAT_NAME') ?></label>
          <div class="input-wrapper">
            <input type="text" class="form-control" id="category-name" name="category-name"
              placeholder="<?php echo lang('CAT_NAME_PLACEHOLDER') ?>" required autocomplete='off'>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label" for="category-description"><?php echo lang('CAT_DESCRIPTION') ?></label>
          <div class="input-wrapper">
            <input type="text" class="form-control" id="category-description" name="category-description"
              placeholder="<?php echo lang('CAT_DESC_PLACEHOLDER') ?>" required autocomplete='off'>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label" for="category-order"><?php echo lang('CAT_ORDER') ?></label>
          <div class="input-wrapper">
            <input type="number" class="form-control" id="category-order" name="category-order"
              placeholder="<?php echo lang('CAT_ORDER_PLACEHOLDER') ?>">
          </div>
        </div>
        <div class="mb-3">
          <label for="category-visable" class='form-label'> <?php echo lang("CAT_VISABLE") ?> </label>
          <select class="form-select" id="category-visable" name="category-visable">
            <option value="0"> <?php echo lang("VIS_YES") ?> </option>
            <option value="1"> <?php echo lang("VIS_NO") ?> </option>
          </select>
        </div>
        <div class="mb-3">
          <label for="category-comment" class='form-label'> <?php echo lang("CAT_COMMENT") ?> </label>
          <select class="form-select" id="category-comment" name="category-comment">
            <option value="0"> <?php echo lang("COM_YES") ?> </option>
            <option value="1"> <?php echo lang("COM_NO") ?> </option>
          </select>
        </div>
        <div class="mb-3">
          <label for="category-ads" class='form-label'> <?php echo lang("CAT_ADS") ?> </label>
          <select class="form-select" id="category-ads" name="category-ads">
            <option value="0"> <?php echo lang("ADS_YES") ?> </option>
            <option value="1"> <?php echo lang("ADS_NO") ?> </option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary"> <i class="fa fa-plus"></i> <?php echo lang('ADD_CAT_BTN') ?></button>
      </form>
    </div>
    <?php
    // End Add Page
  elseif ($do == 'Insert'): // Insert Categories Page
    // Check If The User Coming From A Request
    if ($_SERVER['REQUEST_METHOD'] == 'POST'):
      echo '<h1>' . lang('INSERT_CAT') . '</h1>';

      // Get Variables From The Form
      $categoryName = $_POST['category-name'];
      $categoryDesc = $_POST['category-description'];
      $categoryOrder = $_POST['category-order'];
      $categoryVisable = $_POST['category-visable'];
      $categoryComment = $_POST['category-comment'];
      $categoryAds = $_POST['category-ads'];

      // Check If Category Exist In Database

      $check = checkItem('cat_name', 'categories', $categoryName);


      if ($check > 0):
        redirectFuncError(lang("CAT_EXISTS"), 'back');
      else:
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
        redirectFuncSuccess($categoryName . ' ' . lang('INSERT_CAT_SUCCESS'), 'back');
      endif;
    endif;
    // End Insert Page
  elseif ($do == 'Edit'): // Edit Categories Page
    echo 'Welcome To Edit Categories Page';
    // End Edit Page
  elseif ($do == 'Update'): // Update Categories Page
    echo 'Welcome To Update Categories Page';
    // End Update Page
  elseif ($do == 'Delete'): // Delete Categories Page
    echo 'Welcome To Delete Categories Page';
    // End Delete Page
  endif;


  include $temp . 'footer.php'; // Include The Footer File
else:
  header('Location: index.php'); // Redirect To Index Page
  exit();
endif;

ob_end_flush(); // Release The Output
