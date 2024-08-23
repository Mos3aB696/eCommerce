<?php
session_start();
$pageTitle = 'Categories';
include 'init.php';

$categoryid = (isset($_GET['pageid']) && is_numeric($_GET['pageid'])) ? $_GET['pageid'] : 0;
$pageName = '';
if (isset($_GET['pagename'])) :
  $pageName = $_GET['pagename'];
// else :
//   header("Location: index.php");
//   exit();
endif;
?>
<div class="container">
  <h1><?= str_replace("-", " ", $pageName) ?></h1>
  <div class="row">
    <?php
    $items = getItem("category_connect", $categoryid);
    foreach ($items as $item) : ?>
      <div class="col-sm-6 col-md-6 col-lg-3">
        <div class="img-thumbnail item-box text-center">
          <span class="item-price">$<?= $item['item_price'] ?></span>
          <img src="img.png" alt="avatar image" class='mw-100'>
          <div class="caption ">
            <h3>
              <a class="link" href="items.php?itemid=<?= $item['item_id'] ?>">
                <?= $item['item_name'] ?>
              </a>
            </h3>
            <p class="check-description-length"><?= $item['item_description'] ?></p>
          </div>
        </div>
      </div>
    <?php
    endforeach;
    ?>
  </div>
</div>


<?php include $temp . ('footer.php'); ?>