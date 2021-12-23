<?php

include './includes/conn.php';

?>


<aside class="main-sidebar sidebar-dark-primary elevation-4">


  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="./teacher/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <!-- <a href="#" class="d-block"><?php echo $_SESSION['name'] ?></a> -->
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
          <a href="complete-profile.php" class="nav-link">

            <i class="fas fa-list-ul"></i>
            <p>Complete Profile</p>
          </a>

        </li>
        <li class="nav-item">
          <a href="profile.php" class="nav-link">
            <i class="fas fa-eye"></i>
            <p>Update/View Profile</p>
          </a>

        </li>
        <li class="nav-item">
          <a href="feedback.php" class="nav-link">
            <i class="far fa-edit"></i></i>
            <p>Issued Feedback </p>
          </a>

        </li>
        <li class="nav-item">
          <a href="logout.php" class="nav-link">
            <i class="fas fa-sign-out-alt"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>