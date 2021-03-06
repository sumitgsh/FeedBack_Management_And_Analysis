<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit | Admin</title>

    <!-- Google Font: Open Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- Datatable plugin CSS file -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />

    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>


<?php
include '../includes/conn.php';
include "./check.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $message = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['teacher_Id']) || empty($_POST['name']) || empty($_POST['email']) || empty($_POST['department']) || empty($_POST['role'])) {
            echo "error";
            die();
        } else {
            // have to check if 2 hod exist in a dept or not
            $flag = 0;
            $teacher_Id = $_POST['teacher_Id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $department_Id = $_POST['department'];
            $role = $_POST['role'];
            // echo $role;
            if ($role == "hod") {
                $check_hod = "SELECT `teacher_Id`FROM `teacher` WHERE role='hod' AND department_Id='$department_Id'";
                $result_hod = $conn->query($check_hod);
                if ($result_hod->num_rows > 0) {
                    while ($row = $result_hod->fetch_assoc()) {
                        $flag = 1;
                        echo  '<div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-bottom:0;border-radius:0;">
                        <strong> Department can have one hod only !!. </strong>
                        <p>Change Hod to teacher First</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                    }
                }
            }
            if ($flag == 0) {
                $sql = "UPDATE `teacher` SET `name`='$name',`email`='$email',`department_Id`='$department_Id', `role`='$role' WHERE `teacher_Id`='$teacher_Id'";
                if ($conn->query($sql) === TRUE) {
                    echo  '<div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom:0;border-radius:0;">
                <strong> Updated Successfully !! </strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
                } else {
                    // echo $conn->error;
                    echo  '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-bottom:0;border-radius:0;">
                <strong> Updated Fail !! </strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
                }
            }
        }
    }

    $teacher = "SELECT `teacher_Id`, `name`, `email`, `department_Id`,`role` FROM `teacher` WHERE `verified`=1";
    $result = $conn->query($teacher);
    $r = "";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $teacher_Id = $row["teacher_Id"];
            $name = $row["name"];
            $email  = $row["email"];
            $department_Id = $row["department_Id"];
            $role = $row["role"];
            $dept = "SELECT `name` FROM `department` WHERE `department_Id`='$department_Id'";
            $dResult = $conn->query($dept);
            if ($dResult->num_rows > 0) {
                while ($row = $dResult->fetch_assoc()) {
                    $dept_Name = $row["name"];
                }
            }
            $r = $r . '<tr>
                <td>' . $teacher_Id . '</td>
                <td>' . $name . '</td>
                <td>' . $email . '</td>
                <td>' . $dept_Name . '</td>
                <td>' . $role . '</td>
                <td><button type="button" class="btn btn-primary" class="addAttr" data-toggle="modal" data-target="#addModal" 
                data-id="' . $teacher_Id . '" data-name="' . $name . '" data-email="' . $email . '"
                 data-department_Id="' . $department_Id . '" data-department_Name="' . $dept_Name . '" data-role="' . $role . '"> Edit</button></td>
            </tr><br>';
        }
    }
}



?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include './main-nav.php' ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include './main-sidebar.php' ?>
        <!-- Main SideBar End -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Edit Teacher</h1>
                        </div>
                    </div>
                    <?php echo $message; ?>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="tableID" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Departemnt</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    echo $r;
                                    ?>
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Footer -->
        <?php include './footer.php' ?>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <!-- jQuery library file -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js">
    </script>

    <!-- Datatable plugin JS library file -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js">
    </script>

    <script src=//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin=anonymous>
    </script>

    <!-- Page specific script -->
    <script>
    /* Initialization of datatable */
    $(document).ready(function() {
        $('#tableID').DataTable({});
    });
    </script>
    <script>
    $("button").on("click", function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var email = $(this).data('email');
        var department_Id = $(this).data('department_id');
        var role = $(this).data('role');
        $('#teacher_Id').val(id);
        $('#name').val(name);
        $('#email').val(email);
        $('#department').val(department_Id);
        $('#role').val(role);
    });
    </script>


    <!-- Modal -->
    <div id="addModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Teacher</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="teacher_Id">Teacher Id</label>
                                <input type="text" class="form-control" name="teacher_Id" id="teacher_Id" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="department">Department</label>
                                <select class="form-control select2 select2-danger"
                                    data-dropdown-css-class="select2-danger" style="width: 100%;" name="department"
                                    id="department" required>
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
                                    data-dropdown-css-class="select2-danger" style="width: 100%;" id="role" name="role"
                                    required>
                                    <option value="teacher">Teacher</option>
                                    <option value="hod">HOD</option>
                                </select>
                            </div>

                            <div class="card-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
</body>

</html>