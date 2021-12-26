<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Teacher | Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>


<?php
include "./check.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../includes/conn.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        if (empty($_POST['teacher_Id']) || empty($_POST['name']) || empty($_POST['email']) || empty($_POST['department']) || empty($_POST['role'])) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-bottom:0;border-radius:0;">
                <strong>Empty </strong> Field !!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
        } else {
            $teacher_Id = $_POST['teacher_Id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $department_Id = $_POST['department'];
            $role = $_POST['role'];
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $tpass = substr(str_shuffle($chars), 0, 8);
            $password = password_hash($tpass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `teacher`(`teacher_Id`, `name`, `email`, `department_Id`, `role`, `password`) VALUES ('$teacher_Id','$name','$email','$department_Id','$role','$password')";
            if ($conn->query($sql) === TRUE) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom:0;border-radius:0;">
                <strong>Teacher </strong> Successfully Added !!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
                include "./send-teacher-mail.php";
            } else {
                //echo $conn->error;
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-bottom:0;border-radius:0;">
                <strong>Try </strong> Again !!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
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
                                        Add Teacher
                                    </div>
                                </div>
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="teacher_Id">Teacher Id</label>
                                            <input type="text" class="form-control" name="teacher_Id" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" name="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="department">Department</label>
                                            <select class="form-control select2 select2-danger"
                                                data-dropdown-css-class="select2-danger" style="width: 100%;"
                                                name="department" id="department" required>
                                                <?php
                                                include '../includes/conn.php';
                                                if ($conn->connect_error) {
                                                    die("Connection failed: " . $conn->connect_error);
                                                } else {
                                                    $sql = "SELECT `department_Id`, `name` FROM `department`";
                                                    $result = $conn->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo '<option value="' . $row["department_Id"] . '">' . $row["name"] . '</option>';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="role">Role</label>
                                            <select class="form-control select2 select2-danger"
                                                data-dropdown-css-class="select2-danger" style="width: 100%;"
                                                name="role" required>
                                                <option value="teacher">Teacher</option>
                                                <option value="hod">HOD</option>
                                            </select>
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
    $(function() {
        bsCustomFileInput.init();
    });
    </script>
</body>

</html>