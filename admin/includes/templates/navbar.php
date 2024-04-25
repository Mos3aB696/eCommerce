<!-- Use Bootstrap Component To Create Navbar ودي اول واخر مره استخدم ابن الجزمه دا تاني طلع عين اهلي لو عملته انا ما كنت خدت ربع الوقت -->
<nav class="navbar navbar-expand-lg bg-body">
  <div class="container">
    <a class="navbar-brand" href="dashboard.php"><?php echo lang("HOME_ADMIN") ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#"><?php echo lang("SECTIONS") ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><?php echo lang("ITEMS") ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="members.php"><?php echo lang("MEMBERS") ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><?php echo lang("STATISTICS") ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><?php echo lang("LOGS") ?></a>
        </li>
      </ul>
      <li class="navbar-nav dropdown">
        <a class="nav-link dropdown-toggle active user_name" href="#" role="button" data-bs-toggle="dropdown"
          aria-expanded="false">
          <!-- To Display Admin Name If There Are More Than One Admin -->
          <?php echo $_SESSION['user_name']; ?>
        </a>
        <ul class="dropdown-menu user_ul">
          <li><a class="dropdown-item user_options"
              href="members.php?do=Edit&id=<?php echo $_SESSION['user_id'] ?>"><?php echo lang("EDIT_PROFILE") ?></a>
          </li>
          <li><a class="dropdown-item user_options" href="#"><?php echo lang("SETTINGS") ?></a></li>
          <li><a class="dropdown-item user_options" href="logout.php"><?php echo lang("LOGOUT") ?></a></li>
        </ul>
      </li>
    </div>
  </div>
</nav>