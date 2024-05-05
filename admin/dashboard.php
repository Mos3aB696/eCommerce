<?php
session_start();
// Check If The User Is Logged In
if (isset($_SESSION['user_name'])):
  $pageTitle = 'Dashboard';
  // Include Required Files
  include ('init.php');

  $limit = 6; // Number Of Latest Users
  $latestUsers = getLatest('*', 'users', 'user_id', $limit); // Latest Users Array
  ?>

  <div class="home-stat">
    <div class="container dash-container text-center">
      <h1 class="text-center"><?php echo lang('DASHBOARD_TITLE'); ?></h1>
      <div class="row">
        <div class="col-lg-3">
          <div class="stat st-members">
            <?php echo lang("TOTLE_MEMBERS") ?>
            <span><a href="members.php"><?php echo countItem('user_id', 'users') ?></a></span>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="stat st-pending">
            <?php echo lang("PENDING_MEMBERS") ?>
            <span><a
                href="members.php?do=Manage&page=Pending"><?php echo countItem('reg_status', 'users', 0) ?></a></span>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="stat st-items">
            <?php echo lang("TOTLE_ITEMS") ?>
            <span>1500</span>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="stat st-comments">
            <?php echo lang("TOTLE_COMMENTS") ?>
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
              <?php echo lang("LATEST") . ' ' . $limit . ' ' . lang("MEMBERS") ?>
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
              <?php echo lang("LATEST_ITEMS") ?>
            </div>
            <div class="panel-body">
              test
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