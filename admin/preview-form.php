<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Preview Form</title>

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
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
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
include "./check.php";
include '../includes/conn.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $message = "";
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        include '../includes/conn.php';
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $feedback_type = $_GET['feedback_type'];
            //get feedback question
            $sql = "SELECT qc.category_Id, qc.question_Id,q.question,q.question_Type FROM `questioncategory` as qc,question q WHERE qc.question_Id=q.question_Id and qc.category_Id='" . $feedback_type . "' order by qc.question_Id,q.question_type";
            $result = $conn->query($sql);
            $r = "<h1>" . ucwords($feedback_type) . " Feedback Form</h1>";
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $r = $r . '<div class="card card-primary">
                                    <div class="card-header">
                                        <div class="card-title">
                                            ' . $row['question'] . '
                                        </div>
                                    </div>';
                    if ($row['question_Type'] == 'rating') {
                        $r = $r . '<div class="card-body">
                                        <input type="radio" id="' . $row['category_Id'] . '" name="' . $row['category_Id'] . '" value="5">
                                        <label for="' . $row['category_Id'] . '">Strongly Agree</label><br>
                                        <input type="radio" id="' . $row['category_Id'] . '" name="' . $row['category_Id'] . '" value="4">
                                        <label for="' . $row['category_Id'] . '">Agree</label><br>
                                        <input type="radio" id="' . $row['category_Id'] . '" name="' . $row['category_Id'] . '" value="3">
                                        <label for="' . $row['category_Id'] . '">Neutral</label><br>
                                        <input type="radio" id="' . $row['category_Id'] . '" name="' . $row['category_Id'] . '" value="2">
                                        <label for="' . $row['category_Id'] . '">Disagree</label><br>
                                        <input type="radio" id="' . $row['category_Id'] . '" name="' . $row['category_Id'] . '" value="1">
                                        <label for="' . $row['category_Id'] . '">Strogly Disagree</label>
                                    </div>
                                </div>';
                    } else {
                        $r = $r . '<div class="card-body">
                                        <textarea id="' . $row['category_Id'] . '" class="form-control" name="' . $row['category_Id'] . '" rows="4" cols="50" required></textarea>
                                    </div>';
                    }
                }
            }
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
                            <h1>Preview form <?php echo $message ?></h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <div class="form-group">
                                    <label for="feedback_type">Select Type</label><br>
                                    <select name="feedback_type" id="feedback_type"
                                        class="form-control select2 select2-danger"
                                        data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="alumni">Alumni</option>
                                        <option value="employer">Employer</option>
                                        <option value="parent">Parent</option>
                                        <option value="student">Student</option>
                                        <option value="teacher">Teacher</option>
                                    </select><br>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Preview</button>
                                </div>

                            </form>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 >
                            <form action="">
                                <div class=" card card-primary col-md-8 p-4" style="margin: auto;">
                            <?php echo $r; ?>
                        </div>
                        </form>
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
</body>

</html>