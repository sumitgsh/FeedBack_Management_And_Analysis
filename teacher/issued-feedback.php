<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Issued | Teacher</title>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Raleway&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="./plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="./plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="./plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="./plugins/daterangepicker/daterangepicker.css">

    <!-- Datatable plugin CSS file -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />

    <!-- Custome css !-->
    <link rel="stylesheet" href="../assets/css/teacher_dash.css">

</head>

<?php
include '../includes/conn.php';
include './check.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $feedback = "SELECT DISTINCT department.name as dName,course.course_Name,course.course_Code,coursetaught.session,coursetaught.year,courseTaught.course_Taught_Id,
                issue_date,closing_date,feedback_receiveables.status, feedback_receiveables.feedback_R_Id, feedback_receiveables.issued_For FROM`coursetaken`,`coursetaught`,`program`,`department`,
                `course` ,`feedback_receiveables`,`teacher`WHERE teacher.teacher_Id=coursetaught.teacher_Id AND coursetaken.course_Taught_Id=coursetaught.course_Taught_Id AND
                 coursetaught.course_Code=course.course_Code AND course.department_Id=department.department_Id  AND  feedback_receiveables.issued_By='$teacher_Id' ORDER BY closing_date DESC";
    $result = $conn->query($feedback);
    $r = "";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $department  = $row["dName"];
            $courseName = $row["course_Name"];
            $course_Code = $row["course_Code"];
            $issue_date = $row["issue_date"];
            $closing_date = $row["closing_date"];
            $course_Taught_Id = $row["course_Taught_Id"];
            $id = $row["feedback_R_Id"];
            $issued_For = $row["issued_For"];
            $date = date("Y-m-d");

            $b = '<a class="btn btn-primary" href="/feedback/FeedBack_Management_And_Analysis/teacher/issue-feedback?course_Taught_Id=' . $course_Taught_Id . '">Edit</a></td>';

            $r = $r . '<tr>
                <td>' . $id . '</td>
                <td>' . $issue_date . '</td>
                <td>' . $closing_date . '</td>
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

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Feedback Issued</h1>
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
    </div>
    </div>
    </div>
    </div>
</body>

</html>