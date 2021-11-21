<?php

include '../includes/conn.php';
session_start();

$department_Id = $_SESSION['department_Id'];

$selected_students = "";

// Show the Selected Students in the Dashboard after selecting based on student_ID

$stu_sel_det = "SELECT student.student_Id,roll_No,department.name,program_Name,semester FROM student,department,program,coursetaken where student.program_Id=program.program_Id 
                    AND program.department_Id=department.department_Id AND student.student_Id=coursetaken.student_Id";

$result = $conn->query($stu_sel_det);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $student_Id = $row["student_Id"];
        $roll_No = $row["roll_No"];
        $department = $row["name"];
        $program_Name = $row["program_Name"];
        $semester = $row["semester"];

        $selected_students = $selected_students . '<tr>
                <td>' . $roll_No . '</td>
                <td>' . ucwords($department) . '</td>
                <td>' . ucwords($program_Name) . '</td>
                <td>' . ucwords($semester) . '</td></tr>';
    }
}






//Selects all the students belong to the department
// select student_Id,department.name,program_Name,semester from student,department,program where department.department_Id='CSE_TU_2';

$student_detail = "SELECT student_Id,roll_No,department.name,program_Name,semester FROM student,department,program where student.program_Id=program.program_Id 
                    AND program.department_Id=department.department_Id";

$result = $conn->query($student_detail);
$r = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $student_Id = $row["student_Id"];
        $roll_No = $row["roll_No"];
        $department = $row["name"];
        $program_Name = $row["program_Name"];
        $semester = $row["semester"];

        $r = $r . '<tr>
                <td>' . $roll_No . '</td>
                <td>' . ucwords($department) . '</td>
                <td>' . ucwords($program_Name) . '</td>
                <td>' . ucwords($semester) . '</td>
                <td><input type="checkbox" name="student_Ids[]" value="' . $student_Id . '" ></td></tr>';
    }
}
?>

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

            <!-- Selected Students-->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-12">
                            <h1>Selected Students</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="" class="" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Roll No</th>
                                        <th>Department</th>
                                        <th>Programme</th>
                                        <th>Semester</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    echo $selected_students;
                                    ?>
                                    <tr>


                                    </tr>
                                </tbody>
                            </table>

                            <div class="row mt-4 p-2">
                                <div class="col-md-9"></div>
                                <div class="col-md-1">
                                    <button class="btn btn-primary" style="width: 100%;">Modify</button>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-danger" style="width: 100%;">Stop</button>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-success" style="width: 100%;">Publish</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid filter_cont mt-3 mb-3">
                    <div class="row mb-2">
                        <div class="col-12">
                            <h1>Select Students who will receive the Feedback</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Filter By:<h5>
                        </div>
                    </div>
                    <div class="row mb-2">

                        <div class="col-md-3">
                            <div>
                                <label>Department: </label>
                                <select style="height:2.5rem;width:100%;" class="form-select form-select-lg mb-3"
                                    aria-label=".form-select-lg example">
                                    <option selected>All</option>
                                    <?php
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    } else {
                                        $sql = "SELECT `department_Id`, `name`, FROM `department`";
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
                        </div>
                        <div class="col-md-5">
                            <div>
                                <label>Programme: </label>

                                <select style="height:2.5rem;width:100%;" class="form-select form-select-lg mb-3"
                                    aria-label=".form-select-lg example">
                                    <option selected>All</option>
                                    <?php
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    } else {
                                        $sql = "SELECT `program_Id`, `program_Name` FROM `program`";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<option value="' . $row["program_Id"] . '">' . $row["program_Name"] . '</option>';
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="filter_field">
                                <label>Semester: </label>
                                <select style="height:2.5rem;width:100%;" class="form-select form-select-lg"
                                    aria-label=".form-select-lg example">
                                    <option selected>All</option>
                                    <option value="1">CSE</option>
                                    <option value="2">MCJ</option>
                                    <option value="3">MBBT</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2 d-flex align-items-center" style="margin-top: 1rem;">
                            <div>
                                <button class="btn btn-success">Search</button>
                            </div>
                        </div>

                    </div>

                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    <form method="POST"
                        action="course-taken.php?course_Taught_Id=<?php echo $_GET['course_Taught_Id'] ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="tableID" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Roll No</th>
                                            <th>Department</th>
                                            <th>Programme</th>
                                            <th>Semester</th>
                                            <th>Select</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        echo $r;
                                        ?>
                                    </tbody>

                                </table>
                                <div class="row mt-4 p-2">
                                    <div class="col-md-2 offset-md-5">
                                        <button type="submit" name="submit" class="btn btn-primary">Save
                                            Selected</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
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