<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FeedBack Management|Teacher Dashboard</title>

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

//Include the teacher Id and Department Id
include './check.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    }
    
    $course_Taught = "SELECT `course_Taught_Id`, `course_Code`, `session`, `year` FROM `coursetaught` WHERE teacher_Id='$teacher_Id'";
    $result = $conn->query($course_Taught);
    $r = "";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $course_Taught_Id  = $row["course_Taught_Id"];
            $course_Code = $row["course_Code"];
            $year = $row["year"];
            $session = $row["session"];
                    
            $course = "SELECT `course_Name`, `course_Code`  FROM `course` WHERE `department_Id`='$department_Id'";
            $courseResult = $conn->query($course);
            
            if ($courseResult->num_rows > 0) {
                while ($rowCourse = $courseResult->fetch_assoc()) {
                    $course_Name = $rowCourse['course_Name'];
                    $course_Code = $rowCourse['course_Code'];
                   
                    $teacher = "SELECT `name`,`department_Id` FROM `teacher` WHERE `teacher_Id`='$teacher_Id' ";
                    $teacherResult = $conn->query($teacher);
                    if ($teacherResult->num_rows > 0) {
                        while ($rowTeacher = $teacherResult->fetch_assoc()) {
                            $dept = "SELECT `name` FROM `department` WHERE `department_Id`='$department_Id'";
                            $dResult = $conn->query($dept);
                            if ($dResult->num_rows > 0) {
                                while ($row = $dResult->fetch_assoc()) {
                                    $dept_Name = $row["name"];
                                }
                            }
                        }
                    }
                    $r = $r . '<tr>
                <td>' . $course_Name . '</td>
                <td>' . $dept_Name . '</td>
                <td>' . ucwords($session) . '</td>
                <td>' . $year . '</td>
                <td>
                <a class="btn btn-primary" href="issue-feedback.php?course_Taught_Id=' . $course_Taught_Id . '">Add Student</a></td>
            </tr><br>';
                }
            }
        }
    }
}

?>

<body>

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
                        <h1>Course Taught</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <table id="tableID" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Departemnt</th>
                                    <th>Session</th>
                                    <th>Year</th>
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
     <!-- jQuery -->
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


    <!-- Datatable plugin JS library file -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js">
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
            var question = $(this).data('question');
            var question_Type = $(this).data('qt');
            var alumni = $(this).data('alumni');
            var employer = $(this).data('employer');
            var student = $(this).data('student');
            var parent = $(this).data('parent');
            var teacher = $(this).data('teacher');
            console.log(alumni, employer, student, parent, teacher);
            $('#question_Id').val(id);
            $('#question').val(question);
            $('#question_Type').val(question_Type);
        });
    </script>
</body>

</html>