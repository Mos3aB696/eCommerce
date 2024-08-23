<?php

$pageTitle = 'Dashboard';

session_start();
// Check If The User Is Logged In
if (isset($_SESSION['admin_name'])) :
  // Include Required Files
  include('init.php');

  $limit = 4; // Number Of Latest Users
  $latestUsers = getLatest('*', 'users', 'user_id', $limit); // Latest Users Array

  $latestItems = getLatest('*', 'items', 'item_id', $limit); // Latest Items Array
?>

  <div class="home-stat">
    <div class="container dash-container text-center">
      <h1 class="text-center"><?= lang('DASHBOARD_TITLE'); ?></h1>
      <div class="row">
        <div class="col-lg-3">
          <div class="stat st-members">
            <?= lang("TOTLE_MEMBERS") ?>
            <span><a href="members.php"><?= countItem('user_id', 'users') ?></a></span>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="stat st-pending">
            <?= lang("PENDING_MEMBERS") ?>
            <span><a href="members.php?do=Manage&page=Pending"><?= countItem('reg_status', 'users', 0) ?></a></span>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="stat st-items">
            <?= lang("TOTLE_ITEMS") ?>
            <span><a href="items.php?do=Manage"><?= countItem('item_id', 'items') ?></a></span>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="stat st-comments">
            <?= lang("TOTLE_COMMENTS") ?>
            <span><a href="comments.php?do=Manage"><?= countItem('comment_id', 'comments') ?></a></span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="latest">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <i class="fa fa-users"></i>
              <?= lang("LATEST_MEMBERS") ?>
            </div>
            <div class="panel-body list-group">
              <?php
              if (!empty($latestUsers)) :
                foreach ($latestUsers as $user) :
                  echo '<a href="members.php?do=Edit&id=' . $user['user_id'] .
                    '"class="list-group-item list-group-item-action  list-items" >' . $user['user_name'] . '</a>';
                endforeach;
              else :
                echo '<div class="alert alert-info">There\'s No Members To Show</div>';
              endif;
              ?>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <i class="fa fa-tag"></i>
              <?= lang("LATEST_ITEMS") ?>
            </div>
            <div class="panel-body list-group">
              <?php
              if (!empty($latestItems)) :
                foreach ($latestItems as $item) :
                  echo '<a href="items.php?do=Edit&id=' . $item['item_id'] .
                    '"class="list-group-item list-group-item-action  list-items" >' . $item['item_name'] . '</a>';
                endforeach;
              else :
                echo '<div class="alert alert-info">There\'s No Items To Show</div>';
              endif;
              ?>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-default mb-4">
            <div class="panel-heading">
              <i class="fa fa-comments"></i>
              <?= lang('LATEST_COMMENTS') ?>
            </div>
            <div class="panel-body">
              <?php
              $stmt = $connect->prepare("SELECT
                                      comments.*,
                                      users.user_name AS user
                                    FROM
                                      comments
                                    INNER JOIN
                                      users
                                    ON
                                      users.user_id = comments.user_connect
                                    ORDER BY
                                      comment_id 
                                    DESC
                                    LIMIT $limit");
              $stmt->execute();
              $comments = $stmt->fetchAll();
              if (!empty($comments)) :
                foreach ($comments as $comment) :
                  if ($comment['comment_status'] == 0) :
                    echo '<div class="comment-box opacity-75 ">';
                    echo '<a href="members.php?do=Edit&id=' . $comment['user_connect'] .
                      '"class="member-name list-group-item list-group-item-action">' . $comment['user'] . '</a>';
                    echo '<a href="comments.php?do=Approve&id=' . $comment['comment_id'] .
                      '" class="member-comment list-group-item list-group-item-action">' . $comment['comment_content'] . '</a>';
                    echo '</div>';
                  else :
                    echo '<div class="comment-box ">';
                    echo '<a href="members.php?do=Edit&id=' . $comment['user_connect'] .
                      '"class="member-name list-group-item list-group-item-action">' . $comment['user'] . '</a>';
                    echo '<a href="comments.php?do=Edit&id=' . $comment['comment_id'] .
                      '" class="member-comment list-group-item list-group-item-action">' . $comment['comment_content'] . '</a>';
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

<?php

  include $temp . ('footer.php');

else :
  header('Location: index.php');
  exit();
endif;
