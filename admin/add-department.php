<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FeedBack Management| Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include '../includes/conn.php';
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } else {
    $department_Id = strtolower($_POST["department_Id"]);
    $department_Name = ucwords(strtolower($_POST["department_Name"]));
    try {
      $sql = "INSERT INTO `department`(`department_Id`, `name`) VALUES ('$department_Id','$department_Name')";
      if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom:0;border-radius:0;">
                <strong>Department </strong> Successfully Added !!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-bottom:0;border-radius:0;">
                <strong>Department Id Already Exist!!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      }
    } catch (Exception $e) {
      //throw $th;
      echo $e;
      echo "exp";
    }
  }
}
?>


<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <?php include './main-nav.php' ?>
    <!-- Navbar -->

    <!-- /.navbar -->
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include './main-sidebar.php' ?>
    <!-- Sidebar -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Teacher</h1>
            </div>

          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <div class="card card-primary">
                <div class="card-header">
                  <div class="card-title">
                    Add Department
                  </div>
                </div>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="department_Id">Department Id</label><br>
                      <input type="text" class="form-control" name="department_Id" required>
                    </div>
                    <div class="form-group">
                      <label for="department_Name">Department Name</label>
                      <input type="text" class="form-control" name="department_Name" required>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include './footer.php' ?>>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- bs-custom-file-input -->
  <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- Page specific script -->
  <script>
    // Dismiss the alert after 5 Sec
    // setTimeout(
    //   function() {
    //     $(".alert").alert('close')
    //   }, 2000)


    $(function() {
      bsCustomFileInput.init();
    });
  </script>
</body>

</html>