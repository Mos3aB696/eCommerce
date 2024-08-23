<?php
ob_start();
session_start();
$pageTitle = 'Profile';
include 'init.php';
global $connect;

if (isset($_SESSION['user_name'])) :
  $stmt = $connect->prepare(" SELECT * FROM users WHERE user_name = ?");
  $stmt->execute([$sessionUser]);
  $userInfo = $stmt->fetch();
?>
  <div class="container">
    <h1 class="text-center"><?= lang('USER_PROFILE') ?></h1>
    <div class="my-info custom-profile">
      <div class="card">
        <div class="card-heading bg-primary text-white p-2 ">
          <div><i class="fa fa-address-card" aria-hidden="true"></i> <?= lang('USER_INFO') ?></div>
          <a href="editUserInfo.php?id=<?= $_SESSION['user_id'] ?>"><i class="fa fa-edit"></i> <?= lang("EDIT_BTN") ?></a>
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
    <div class="my-ads custom-profile">
      <div class="card">
        <div class="card-heading bg-primary text-white p-2 ">
          <div>
            <i class="fa fa-shopping-cart fa-fw" aria-hidden="true"></i>
            <?= lang('USER_ADS') ?>
          </div>

          <a href="createAd.php"><i class="fa fa-plus"></i> <?= lang("ADD_ITEM_BTN") ?></a>
        </div>
        <div class="card-body">
          <div class="row">
            <?php
            $items = getItem("user_connect", $userInfo['user_id'], 1);
            if (!empty($items)) :
              foreach ($items as $item) :
            ?>
                <?php if ($item['item_approve'] == 1): ?>
                  <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="img-thumbnail item-box text-center">
                      <span class="item-price">$<?= $item['item_price'] ?></span>
                      <img src="img.png" alt="avatar image" class='mw-100'>
                      <div class="caption">
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
                else: ?>
                  <div class="col-sm-6 col-md-6 col-lg-3 text-center">
                    <div class="img-thumbnail item-box opacity-50">
                      <span class="item-price">$<?= $item['item_price'] ?></span>
                      <img src="img.png" alt="avatar image" class='mw-100'>
                      <div class="caption">
                        <h3>
                          <a class="link user-select-none">
                            <?= $item['item_name'] ?>
                          </a>
                        </h3>
                        <p class="check-description-length"><?= $item['item_description'] ?></p>
                      </div>
                    </div>
                  </div>
            <?php
                endif;
              endforeach;
            else :
              echo  "<span>" . lang('NO_ADS') . "</span>";
            endif;
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="latest">
      <div class="row">
        <div class="col-sm-12">
          <div class="card mb-4">
            <div class="card-heading bg-primary text-white p-2 ">
              <i class="fa fa-comments"></i>
              <?= lang('USER_COMMENTS') ?>
            </div>
            <div class="card-body">
              <?php
              $stmt = $connect->prepare("SELECT
                                      comments.*,
                                      items.item_name AS item,
                                      users.user_id AS user
                                    FROM
                                      comments
                                    INNER JOIN
                                      items
                                    ON
                                      items.item_id = comments.item_connect
                                    INNER JOIN
                                      users
                                    ON
                                      users.user_id = comments.user_connect
                                    WHERE
                                      users.user_id = ? 
                                    ORDER BY
                                      comment_id 
                                    DESC");
              $stmt->execute([$_SESSION['user_id']]);
              $comments = $stmt->fetchAll();
              if (!empty($comments)) :
                foreach ($comments as $comment) :
                  if ($comment['comment_status'] == 0) :
                    echo '<div class="comment-box opacity-75 ">';
                    echo '<a href="items.php?itemid=' . $comment['item_connect'] .
                      '"class="item-name list-group-item list-group-item-action">' . $comment['item'] . '</a>';
                    echo '<a href="comments.php?do=Approve&id=' . $comment['comment_id'] .
                      '" class="member-comment list-group-item list-group-item-action">' . $comment['comment_content'] . '</a>';
                    echo '</div>';
                  else :
                    echo '<div class="comment-box ">';
                    echo '<a href="items.php?itemid=' . $comment['item_connect']  .
                      '"class="item-name list-group-item list-group-item-action">' . $comment['item'] . '</a>';
                    echo '<span class="member-comment list-group-item list-group-item-action">' . $comment['comment_content'] . '</span>';
                    echo '</div>';
                  endif;
                endforeach;
              else :
                echo '<div class="alert alert-info m-0">' . lang('NO_COMMENTS') . '</div>';
              endif;
              ?>
            </div>
          </div>
        </div>
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
ob_end_flush();
?>