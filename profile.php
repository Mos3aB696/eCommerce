<?php
session_start();
$pageTitle = 'Profile';
include 'init.php';

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
            <?php echo lang("USER_NAME");
            echo ": {$userInfo['user_name']}"; ?>
          </div>
          <div>
            <?php echo lang("USER_FULL_NAME");
            echo ": {$userInfo['full_name']}"; ?>
          </div>
          <div>
            <?php echo lang("USER_EMAIL");
            echo ": {$userInfo['email']}"; ?>
          </div>
          <div>
            <?php echo lang("USER_REGISTERED");
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
          <?= lang('USER_ADS') ?> </div>
        <div class="card-body">
          <div class="row">
            <?php
            $items = getItem("user_connect", $userInfo['user_id']);
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
        <div class="card-body">Comments: Yes</div>
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