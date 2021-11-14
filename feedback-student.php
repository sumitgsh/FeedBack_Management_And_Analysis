<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provide Feedback</title>
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
session_start();
$feedbacker_id = 8;
include './includes/conn.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $message = "";
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $feedback_Id = $_GET['id'];
            $_SESSION['feedback_Id'] = $feedback_Id;
            $feedback_type = $_GET['issued_For'];
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
                                        <input type="radio" id="' . $row['question_Id'] . '" name="' . $row['question_Id'] . '" value="5" >
                                        <label for="' . $row['question_Id'] . '">Strongly Agree</label><br>
                                        <input type="radio" id="' . $row['question_Id'] . '" name="' . $row['question_Id'] . '" value="4">
                                        <label for="' . $row['question_Id'] . '">Agree</label><br>
                                        <input type="radio" id="' . $row['question_Id'] . '" name="' . $row['question_Id'] . '" value="3">
                                        <label for="' . $row['question_Id'] . '">Neutral</label><br>
                                        <input type="radio" id="' . $row['question_Id'] . '" name="' . $row['question_Id'] . '" value="2">
                                        <label for="' . $row['question_Id'] . '">Disagree</label><br>
                                        <input type="radio" id="' . $row['question_Id'] . '" name="' . $row['question_Id'] . '" value="1">
                                        <label for="' . $row['question_Id'] . '">Strogly Disagree</label>
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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $feedback_id = $_SESSION['feedback_id'];
        foreach ($_POST as $key => $value) {
            if ($key != 'submit') {
                $rating = "INSERT INTO `feedback` (`feedback_id`, `feedbacker_id`, `question_Id`, `answer`) VALUES ($feedback_id,$feedbacker_id,$key,'$value')";
                if ($conn->query($rating) == true) {
                    echo $feedback_id . "Field " . htmlspecialchars($key) . " " . $feedbacker_id . "is " . htmlspecialchars($value) . "<br>";
                } else {
                    echo $conn->error;
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
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="POST" action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <div class=" card card-primary col-md-8 p-4" style="margin: auto;">
                                    <?php echo $r; ?>
                                    <div class="card-footer">
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </div>
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