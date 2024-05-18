<?php

$pageTitle = 'Dashboard';

session_start();
// Check If The User Is Logged In
if (isset($_SESSION['user_name'])):
  // Include Required Files
  include ('init.php');

  $limit = 5; // Number Of Latest Users
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
            <span>3500</span>
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
              <?= lang("LATEST") . ' ' . $limit . ' ' . lang("MEMBERS") ?>
            </div>
            <div class="panel-body list-group">
              <?php
              foreach ($latestUsers as $user):
                echo '<a href="members.php?do=Edit&id=' . $user['user_id'] . '"class="list-group-item list-group-item-action  list-items" >' . $user['user_name'] . '</a>';
              endforeach;
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
              foreach ($latestItems as $item):
                echo '<a href="items.php?do=Edit&id=' . $item['item_id'] . '"class="list-group-item list-group-item-action  list-items" >' . $item['item_name'] . '</a>';
              endforeach;
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php

  include $temp . ('footer.php');

else:
  header('Location: index.php');
  exit();
endif;