<?php

include './includes/conn.php';
include './check.php';

if (isset($_POST['complete_profile'])) {

    //Get the all value on form submit
    $department_Id = $_POST['department'];
    $program_Id = $_POST['program'];
    $parent_Phone_No = $_POST['parent_Phone_No'];
    $parent_Name = $_POST['parent_Name'];
    $semester = $_POST['semester'];
    $relation = $_POST['relation'];

    //Based on the selected field update the student table

    $sql = "UPDATE student SET program_Id='$program_Id',parent_Phone_No='$parent_Phone_No' 
                ,parent_Name='$parent_Name',semester='$semester',relation='$relation' where roll_No='$roll_No'";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $message = '<div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom:0;border-radius:0;">
                <strong> Profile Updated  !! </strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
    } else {
        $message = '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-bottom:0;border-radius:0;">
        <strong> Profile Updation Failed !! </strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
  
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- Datatable plugin CSS file -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />

    <!-- Google Font: Open Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./teacher/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="./teacher/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="./teacher/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="./teacher/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./teacher/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="./teacher/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="./teacher/plugins/daterangepicker/daterangepicker.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">


        <!-- Navbar -->
        <?php include './main-nav.php' ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include './main-sidebar.php' ?>
        <!-- Main SideBar End -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                       
                        <?php
                            if(isset($_POST['complete_profile']))
                            {
                                echo $message;
                            }
                        ?>
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
                                        Complete Profile
                                    </div>
                                </div>
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="department">Department</label><br>
                                            <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" name="department" id="department-sel" required>
                                                <?php
                                                $programid = "SELECT * from department";
                                                $result = $conn->query($programid);
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo '<option value="' . $row["department_Id"] . '" selected>' . $row["name"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>


                                        </div>
                                        <div class="form-group">
                                            <label for="department">Programme Name</label><br>
                                            <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" name="program" id="programme_filter" required>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="question">Semester</label><br>
                                            <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" name="semester" id="semester" required>
                                                <option value="1">1
                                                </option>
                                                <option value="2">2
                                                </option>
                                                <option value="3">3
                                                </option>
                                                <option value="4">4
                                                </option>
                                                <option value="5">5
                                                </option>
                                                <option value="6">6
                                                </option>
                                                <option value="7">7
                                                </option>
                                                <option value="8">8
                                                </option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="department">Parent Name</label><br>
                                            <input type="text" class="form-control" name="parent_Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="parent_Phone_No">Parent Phone Number</label><br>
                                            <input type="number" class="form-control" name="parent_Phone_No" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="relation">Relation</label><br>
                                            <input type="text" class="form-control" name="relation" required>
                                        </div>

                                        <div class="card-footer">
                                            <button type="submit" name="complete_profile" class="btn btn-primary">Submit</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div>
                    <?php include './footer.php' ?>
                </div>
            </section>

        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>

        <!-- jQuery library file -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js">
        </script>

        <!-- Datatable plugin JS library file -->
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js">
        </script>

        <script src=//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin=anonymous>
        </script>
        <script>
            // Show the programme based on selected department..
            $("#department-sel").on('change', function() {
                var val = $(this).val();
                $.ajax({
                    url: "filter-programme.php",
                    data: {
                        department_Id: val
                    },
                    type: "POST",
                    context: document.body,
                    success: function(result) {
                        document.getElementById("programme_filter").innerHTML = result;
                    }
                });
            });
        </script>
        <!-- Footer -->

    </div>

    <!-- jQuery -->
    <script src="./teacher/"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="./teacher/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>


    <!-- Bootstrap 4 -->
    <script src="./teacher/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="./teacher/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="./teacher/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="./teacher/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="./teacher/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="./teacher/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="./teacher/plugins/moment/moment.min.js"></script>
    <script src="./teacher/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="./teacher/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="./teacher/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="./teacher/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./teacher/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="./teacher/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="./teacher/dist/js/pages/dashboard.js"></script>
</body>

</html>