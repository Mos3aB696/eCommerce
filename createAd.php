<?php
ob_start();
session_start();
$pageTitle = 'Add Item';
include 'init.php';
global $connect;

if (isset($_SESSION['user_name'])) :
  if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    // Get Variables From The Form And Filter Them
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT);
    $itemName = strip_tags($_POST['item-name']);
    $itemDesc = strip_tags($_POST['item-description']);
    $itemPrice = filter_input(INPUT_POST, 'item-price', FILTER_SANITIZE_NUMBER_INT);
    $itemCountry = strip_tags($_POST['item-country']);
    $itemStatus = filter_input(INPUT_POST, 'item-status', FILTER_SANITIZE_NUMBER_INT);

    $formErrors = [];
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
    elseif (strlen($itemDesc) < 10) :
      $formErrors[] = lang('ITEM_DESC_LESS');
    endif;
    if (empty($itemPrice)) :
      $formErrors[] = lang('ITEM_PRICE_EMPTY');
    endif;
    if (empty($itemCountry)) :
      $formErrors[] = lang('ITEM_COUNTRY_EMPTY');
    elseif (strlen($itemCountry) < 3 ||  strlen($itemCountry) >= 10):
      $formErrors[] = lang('ITEM_COUNTRY_LESS_OR_MORE');
    endif;
    if ($itemStatus == 0) :
      $formErrors[] = lang('ITEM_STATUS_EMPTY');
    endif;
    if (empty($formErrors)) :
      // Prepare The Insert Query
      $stmt = $connect->prepare("INSERT INTO items
              (item_name, item_description, item_price, country_made, item_status, add_date, category_connect, user_connect)
                                VALUES
              (:zname, :zdesc, :zprice, :zcountry, :zstatus, now(), :zcat, :zuser)");
      // Execute The Query
      $stmt->execute(
        [
          'zname' => $itemName,
          'zdesc' => $itemDesc,
          'zprice' => $itemPrice,
          'zcountry' => $itemCountry,
          'zstatus' => $itemStatus,
          'zcat' => $category,
          'zuser' => $_SESSION['user_id']
        ]
      );
      redirectFuncSuccess($itemName . ' ' . lang('INSERT_ITEM_SUCCESS'), 'profile.php');
    endif;
  endif;

?>
  <h1 class="text-center"><?= lang('CREATE_ITEM') ?></h1>
  <div class="create-ad custom-profile">
    <div class="container custom-container">
      <form action="<?= $_SERVER['PHP_SELF'] ?>" method='POST'>
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
            <input
              pattern=".{4,20}"
              title="Item name must be between 4 - 20 characters"
              type="text"
              class="form-control"
              id="item-name"
              name="item-name"
              placeholder="<?= lang('ITEM_NAME_PLACEHOLDER') ?>"
              required>

          </div>
        </div>
        <div class="mb-3">
          <label class="form-label" for="item-description"><?= lang('ITEM_DESCRIPTION') ?></label>
          <div class="input-wrapper">
            <input
              pattern=".{10,}"
              title="Item description must be at least 10 characters"
              type="text"
              class="form-control"
              id="item-description"
              name="item-description"
              placeholder="<?= lang('ITEM_DESC_PLACEHOLDER') ?>"
              required>
          </div>
        </div>
        <div class="mb-3">
          <label
            class="form-label" for="item-price"><?= lang('ITEM_PRICE') ?></label>
          <div class="input-wrapper">
            <input
              type="text"
              class="form-control"
              id="item-price"
              name="item-price"
              placeholder="<?= lang('ITEM_PRICE_PLACEHOLDER') ?>"
              required>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label" for="item-country"><?= lang('ITEM_COUNTRY') ?></label>
          <div class="input-wrapper">
            <input
              pattern=".{3,10}"
              title="Item country must be between 3 - 10 characters"
              type="text"
              class="form-control"
              id="item-country"
              name="item-country"
              placeholder="<?= lang('ITEM_COUNTRY_PLACEHOLDER') ?>"
              required>
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

        <button type="submit" class="btn btn-primary mb-2 "> <i class="fa fa-plus"></i>
          <?= lang('ADD_ITEM_BTN') ?></button>
      </form>
      <?php
      if (!empty($formErrors)) :
        printErrors();
      endif;
      ?>
    </div>
  </div>

<?php
else :
  header('Location: login.php');
  exit();
endif;
include "{$temp}footer.php";
ob_end_flush();
