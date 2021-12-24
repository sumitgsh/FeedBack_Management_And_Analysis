-
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
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

<?php
include './includes/conn.php';
//include './check.php';
$student_Id = 8;
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $feedback = "SELECT  department.name as dName,course.course_Name,course.course_Code,coursetaught.session,coursetaught.year,courseTaught.course_Taught_Id,
                issue_date,closing_date,feedback_receiveables.status,teacher.name as tName,feedback_receiveables.feedback_R_Id, feedback_receiveables.issued_For FROM`coursetaken`,`coursetaught`,`program`,`department`,
                `course` ,`feedback_receiveables`,`teacher`WHERE teacher.teacher_Id=coursetaught.teacher_Id AND coursetaken.course_Taught_Id=coursetaught.course_Taught_Id AND
                 coursetaught.course_Code=course.course_Code AND course.department_Id=department.department_Id AND coursetaken.student_Id=$student_Id AND feedback_receiveables.issued_For='student'
                  AND feedback_receiveables.status!='stopped' AND (feedback_receiveables.issuer_Domain=coursetaught.course_Taught_Id OR feedback_receiveables.issued_By='hod') ORDER BY closing_date DESC";
    $result = $conn->query($feedback);
    $r = "";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $department  = $row["dName"];
            $issuerName = $row["tName"];
            $courseName = $row["course_Name"];
            $course_Code = $row["course_Code"];
            $issue_date = $row["issue_date"];
            $closing_date = $row["closing_date"];
            $course_Taught_Id = $row["course_Taught_Id"];
            $id = $row["feedback_R_Id"];
            $issued_For = $row["issued_For"];
            $date = date("Y-m-d");
            $check = "SELECT `feedback_id`, `feedbacker_id` FROM `feedback` WHERE feedbacker_id=$student_Id and feedback_id=$id";
            $rCheck = $conn->query($check);
            if ($date >= $issue_date & $date <= $closing_date) {
                if ($result->num_rows > 0) {
                    $b = '<a class="btn btn-info" href="#">Feedback Submited</a></td>';
                } else {
                    $b = '<a class="btn btn-primary" href="feedback-student.php?id=' . $id . '&issued_For=' . $issued_For . '">Provide Feedback</a></td>';
                }
            } else {
                if ($result->num_rows > 0) {
                    $b = '<a class="btn btn-info" href="#">Feedback Submited</a></td>';
                } else {
                    $b = '<button type="button" class="btn btn-primary" disabled>Unavailable</button';
                }
            }
            $r = $r . '<tr>
                <td>' . $id . '</td>
                <td>' . $issue_date . '</td>
                <td>' . $closing_date . '</td>
                <td>' . $issuerName . '</td>
                <td>' . $department . '</td>
                <td>' . $courseName . '</td>
                <td>' . $b . '</tr><br>';
        }
    }
}



?>

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
                        <div class="col-sm-6">
                            <h1>Feedback List</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <table id="tableID" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Issue Date</th>
                                        <th>Closer Date</th>
                                        <th>Issued By</th>
                                        <th>Department</th>
                                        <th>Course</th>
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
        </div>
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
        <script>
        /* Initialization of datatable */
        $(document).ready(function() {
            $('#tableID').DataTable({});
        });
        </script>
        <script>
        $("button").on("click", function() {
            var cid = $(this).data('cid');
            var teacher_Id = $(this).data('teacher');
            var name = $(this).data('name');
            var department_Id = $(this).data('department_id');
            var departemnt_Name = $(this).data('departemnt_name');
            var session = $(this).data('session');
            var year = $(this).data('year');
            var course_Code = $(this).data('course_code');
        });
        </script>

        <!-- Footer -->
        <?php include './footer.php' ?>

    </div>


    <!-- jQuery -->
    <script src="./teacher/"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="./teacher/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
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