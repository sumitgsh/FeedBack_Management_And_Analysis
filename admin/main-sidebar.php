<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index.php" class="brand-link">
    <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">FeedBack Management</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Admin</a>
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
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <li class="nav-item">
          <a href="change-password.php" class="nav-link">
            <i class="fa fa-key" aria-hidden="true"></i>
            <p>
              Change Password</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-plus"></i>
            <p>
              Add
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="add-department.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Department</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="add-teacher.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Teacher</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="add-employer.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Employer</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="add-question.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Questions</p>
              </a>
            </li>


          </ul>
        </li>


        <!-- Edit/View -->

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Edit/View
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="add-department.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Department</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="data.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>View Teacher</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="question.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> View Questions</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="view-employer.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> View Employer</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="analyse.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p> View Analysis</p>
              </a>
            </li>


          </ul>
        </li>


        <!-- Preview -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Preview
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="preview-form.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Question</p>
              </a>
            </li>
          </ul>
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