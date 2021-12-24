<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Issue Feedback | Super Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <link rel=”stylesheet” href=”//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css”>
</head>


<?php
include "./check.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../includes/conn.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $domain = $_POST['domain'];
        $start_date = $_POST['start_date'];
        $closing_date = $_POST['closing_date'];
        if ($start_date > $closing_date) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-bottom:0;border-radius:0;">
                <strong>Check Date </strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
        } else {
            $issue = "INSERT INTO `feedback_receiveables`(`issue_date`, `closing_date`, `status`, `issued_For`, `issued_By`, `issuer_Domain`) VALUES 
            ('$start_date','$closing_date','published','$domain','super','super')";

            if ($conn->query($issue) == true) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom:0;border-radius:0;">
                <strong>Feedback Issued </strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-bottom:0;border-radius:0;">
                <strong>Feedback Issued Failed</strong> 
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
                            <h1>Super Admin</h1>
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
                                        Issue Feedback
                                    </div>
                                </div>
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <div class="card-body">
                                        <div class=" form-group">
                                            <label for="domain">Domain</label>
                                            <select class="form-control select2 select2-danger"
                                                data-dropdown-css-class="select2-danger" style="width: 100%;"
                                                name="domain" id="domain" required>
                                                <option value="Alumni">Alumni
                                                </option>
                                                <option value="employer">Employer
                                                </option>
                                                <option value="parent"> Parent
                                                </option>
                                                <option value="student">Student
                                                </option>
                                                <option value="teacher">Teacher
                                                </option>
                                            </select>
                                        </div>
                                        <div class=" form-group">
                                            <label for="start_date">Start Date</label><br>
                                            <input type="date" class="form-control start_date" name="start_date"
                                                id="start_date" />
                                        </div>
                                        <div class=" form-group">
                                            <label for="closing_date closing_date">Closing Date</label><br>
                                            <input type="date" class="form-control" name="closing_date"
                                                id="closing_date" />
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Publish</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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