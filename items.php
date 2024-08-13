<?php
session_start();
$pageTitle = 'Profile';
include 'init.php';
global $connect;

if (isset($_SESSION['user_name'])) :
  $stmt = $connect->prepare(" SELECT * FROM users WHERE user_name = ?");
  $stmt->execute([$sessionUser]);
  $userInfo = $stmt->fetch();
?>
  <h1 class="text-center"><?= lang('USER_PROFILE') ?></h1>
  <div class="my-info custom-profile">
    <div class="container">
      <div class="card">
        <div class="card-heading bg-primary text-white p-2 ">
          <?= lang('USER_INFO') ?>
        </div>
        <div class="card-body">
          <div>
            <i class="fa fa-unlock-alt fa-fw"></i>
            <?php echo "<span>" . lang("USER_NAME") . "</span>";
            echo ": {$userInfo['user_name']}"; ?>
          </div>
          <div>
            <i class="fa fa-user fa-fw"></i>
            <?php echo "<span>" . lang("USER_FULL_NAME") . "</span>";
            echo ": {$userInfo['full_name']}"; ?>
          </div>
          <div>
            <i class="fa fa-envelope-o fa-fw"></i>
            <?php echo "<span>" . lang("USER_EMAIL") . "</span>";
            echo ": {$userInfo['email']}"; ?>
          </div>
          <div>
            <i class="fa fa-calendar fa-fw"></i>
            <?php echo "<span>" . lang("USER_REGISTERED") . "</span>";
            echo ": {$userInfo['add_date']}"; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="my-ads custom-profile">
    <div class="container">
      <div class="card">
        <div class="card-heading bg-primary text-white p-2 ">
          <div><?= lang('USER_ADS') ?> </div>
          <a href="createAd.php"><i class="fa fa-plus"></i> <?= lang("ADD_ITEM_BTN") ?></a>
        </div>
        <div class="card-body">
          <div class="row">
            <?php
            $items = getItem("user_connect", $userInfo['user_id']);
            if (!empty($items)) :
              foreach ($items as $item) : ?>
                <div class="col-sm-6 col-md-4 col-lg-3">
                  <div class="img-thumbnail item-box">
                    <span class="item-price">$<?= $item['item_price'] ?></span>
                    <img src="img.png" alt="avatar image" class='mw-100'>
                    <div class="caption">
                      <h3><?= $item['item_name'] ?></h3>
                      <p><?= $item['item_description'] ?></p>
                    </div>
                  </div>
                </div>
            <?php
              endforeach;
            else :
              echo  "<span>" . lang('NO_ADS') . "</span>";
            endif;
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="my-comments custom-profile">
    <div class="container">
      <div class="card">
        <div class="card-heading bg-primary text-white p-2 ">
          <?= lang('USER_COMMENTS') ?>
        </div>
        <div class="card-body">
          <?php
          $stmt = $connect->prepare("SELECT comment_content FROM comments WHERE user_connect = ?");
          $stmt->execute([$userInfo['user_id']]);
          $comments = $stmt->fetchAll();
          if (!empty($comments)) :
            foreach ($comments as $comment) :
              echo "<p>{$comment['comment_content']}</p>";
            endforeach;
          else :
            echo "<span>" . lang('NO_COMMENTS') . "</span>";
          endif;
          ?>
        </div>
      </div>
    </div>
  </div>


<?php
else :
  header('Location: login.php');
  exit();
endif;
include "{$temp}footer.php";
?>