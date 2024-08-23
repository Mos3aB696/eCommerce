<?php
ob_start();
session_start();
$pageTitle = 'Homepage';
include 'init.php';
global $connect;
?>
<div class="container mt-5 mb-5">
  <div class="row">
    <?php
    $stmt = $connect->prepare("SELECT
                                  items.*,
                                  categories.cat_name
                                FROM
                                  items
                                INNER JOIN
                                  categories
                                ON
                                  categories.cat_id = items.category_connect
                                WHERE
                                  item_approve = 1
                                ORDER BY 
                                  item_id 
                                DESC
                                ");
    $stmt->execute();

    $items = $stmt->fetchAll();
    foreach ($items as $item) : ?>
      <div class="col-sm-6 col-md-6 col-lg-3 ">
        <div class="img-thumbnail item-box text-center">
          <span class="item-price">$<?= $item['item_price'] ?></span>
          <span class="item-cat"><?= $item['cat_name'] ?></span>
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
<?php
include "{$temp}footer.php";
ob_end_flush();
