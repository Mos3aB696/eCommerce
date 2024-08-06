<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Add Bootstrap library -->
  <link rel="stylesheet" href="<?= $css; ?>bootstrap.min.css">
  <!-- Add fontawesome library -->
  <link rel="stylesheet" href="<?= $css; ?>font-awesome.min.css">
  <!-- Add My CSS File -->
  <link rel="stylesheet" href="<?= $css; ?>frontend.css">
  <title><?php getTitle() ?></title>
</head>

<body>
  <div class="upper-bar">
    <div class="container">
      <?php
      // Check If The User Is Logged In
      if (isset($_SESSION['user_name'])) :
        ?>
        <li class="navbar-nav dropdown">
        <a class="nav-link dropdown-toggle active " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <!-- To Display Admin Name If There Are More Than One Admin -->
          <?= $_SESSION['user_name']; ?>
        </a>
        <ul class="dropdown-menu user_ul">
          <li><a class="dropdown-item user_options" href="profile.php">My Profile</a></li>
          <li><a class="dropdown-item user_options" href="logout.php"><?= lang("LOGOUT") ?></a></li>
        </ul>
      </li>
      <?php
        // echo $_SESSION['user_name'];
        // Check If The User Is Not Activated
        $user_status = checkUserStatus($sessionUser);
        if ($user_status == 1) :
          echo " - Not Activated Yet";
        endif;
      else :
        // If The User Is Not Logged In Show The Link To Login Page
      ?>
        <a class="text-decoration-none" href="login.php">
          <?= lang('SIGNUP_LOGIN') ?>
        </a>
      <?php endif; ?>
      <div id="time">Loading...</div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg bg-body">
    <div class="container">
      <a class="navbar-brand" href="index.php"><?= lang("HOME_PAGE") ?></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarNavDropdown">
        <ul class="navbar-nav">
          <?php
          $categories = getCat();
          foreach ($categories as $category) :
            echo
            "<li class='nav-item'>
              <a class='nav-link' href='categories.php?pageid="
              . $category['cat_id'] . "&pagename=" . str_replace(" ", "-", $category['cat_name']) .
              "'>" . $category['cat_name'] .
              "</a>
            </li>";
          endforeach;
          ?>
        </ul>
      </div>
    </div>
  </nav>

  <?php
