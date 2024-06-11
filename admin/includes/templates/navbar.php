<!-- Use Bootstrap Component To Create Navbar ودي اول واخر مره استخدم ابن الجزمه دا تاني طلع عين اهلي لو عملته انا ما كنت خدت ربع الوقت -->
<nav class="navbar navbar-expand-lg bg-body">
  <div class="container">
    <a class="navbar-brand" href="dashboard.php"><?= lang("HOME_ADMIN") ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <!-- 
          Check If The Current URL Is Equal To The Categories Page URL
            * parse_url => To Get The Path Of The URL
            * $_SERVER["REQUEST_URI"] => To Get The Current URL
            * PHP_URL_PATH => To Get The Path Of The URL
          -->
          <a class="nav-link <?= (parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) == '/admin/categories.php' ? 'active' : '') ?>"
            href="categories.php"><?= lang("CATEGORIES") ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == '/admin/items.php' ? 'active' : '') ?>"
            href="items.php"><?= lang("ITEMS") ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == '/admin/members.php' ? 'active' : '') ?>"
            href="members.php"><?= lang("MEMBERS") ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) == '/admin/comments.php' ? 'active' : '') ?>"
            href="comments.php"><?= lang("COMMENTS") ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="statistics.php"><?= lang("STATISTICS") ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><?= lang("LOGS") ?></a>
        </li>
      </ul>
      <li class="navbar-nav dropdown">
        <a class="nav-link dropdown-toggle active user_name" href="#" role="button" data-bs-toggle="dropdown"
          aria-expanded="false">
          <!-- To Display Admin Name If There Are More Than One Admin -->
          <?= $_SESSION['user_name']; ?>
        </a>
        <ul class="dropdown-menu user_ul">
          <li><a class="dropdown-item user_options"
              href="members.php?do=Edit&id=<?= $_SESSION['user_id'] ?>"><?= lang("EDIT_PROFILE") ?></a>
          </li>
          <li><a class="dropdown-item user_options" href="#"><?= lang("SETTINGS") ?></a></li>
          <li><a class="dropdown-item user_options" href="logout.php"><?= lang("LOGOUT") ?></a></li>
        </ul>
      </li>
    </div>
  </div>
</nav>

<?php
// echo '<pre>';
// print_r(parse_url($_SERVER["REQUEST_URI"]));
// echo '</pre>';