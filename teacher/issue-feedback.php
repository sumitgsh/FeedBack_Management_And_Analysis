<?php
//error_reporting(1);
include '../includes/conn.php';
include './check.php';

$selected_students = "";
$department_Id = $_SESSION['department_Id'];

//Set to global because it will be used in the Show details to filter values..
$sel_roll_No = array();


//Show the Selected Students in the Dashboard after selecting based on student_ID's
if (isset($_POST['stud_sel_sub']) || isset($_GET['course_Taught_Id'])) {
    $selected_students = "";

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
                    <td>' . ucwords($semester) . '</td>
                    <td><button id="del_sel" class="btn btn-danger" class="addAttr" 
                     data-course_taught_id="' . $_GET['course_Taught_Id'] . '" data-student_id="' . $student_Id . '"> Drop</button></td>
                </tr>';
        }
    }
}


//Selects all the students belong to the department
// select student_Id,department.name,program_Name,semester from student,department,program where department.department_Id='CSE_TU_2';


$course_Taught_Id = $_GET['course_Taught_Id'];

//Filtering steps
//[X] check if for the particular course the course taken table is not empty
// This is someone who has taken the course

$course_taken_not_empty = "SELECT * FROM coursetaken where coursetaken.course_Taught_Id=$course_Taught_Id";

$result = $conn->query($course_taken_not_empty);

//NO course available for the course taught
$student_detail = "";
if (($result->num_rows) <= 0) {

    $student_detail = "SELECT DISTINCT student_Id,roll_No,department.name,program_Name,semester FROM student,department,program where student.program_Id=program.program_Id 
                    AND program.department_Id=department.department_Id";
} else {

    //filtering based on the above selected students 
    $student_detail = "select * from student,program,department where student.program_Id=program.program_Id 
    AND department.department_Id=program.department_Id AND student.student_Id 
    NOT IN (select coursetaken.student_Id from coursetaken
    INNER JOIN student
    ON coursetaken.student_Id=student.student_Id
    where coursetaken.course_Taught_Id=$course_Taught_Id)";
}
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


//Find the course name and course Id showing that needs to be shown
// when published button is pressed..
$query = "SELECT coursetaught.course_Code as cc,course.course_Name as cn,closing_date from coursetaught,course,feedback_receiveables where coursetaught.course_Taught_Id=$course_Taught_Id AND coursetaught.course_Code=course.course_Code
         AND feedback_receiveables.issuer_Domain=coursetaught.course_Taught_Id";
$result = $conn->query($query);

if ($result->num_rows == 1) {
    while ($row = $result->fetch_assoc()) {
        $course_name = $row["cn"];
        $course_code = $row["cc"];
        $closing_date = $row["closing_date"];
    }
    //echo $course_name;

}


//When search button is pressed
if (isset($_POST['filter_stud'])) {
    $department_Id = $_POST["department_Id"];

    $program_Id = $_POST["program_Id"];

    $semester = $_POST["semester"];

    // Filtering based on the above selection
    // Filter Query(Based on the columns the values are set,the search query will work)

    // single if condition to check value is empty or not.for non-empty then mysql query is two between 'AND' operation.
    $query = 'SELECT student_Id,roll_No,department.name,program_Name,semester FROM student,department,program';
    $where = ' Where';
    $and = ' student.program_Id=program.program_Id AND program.department_Id=department.department_Id';

    if (($_POST['department_Id']) != 'All') {
        $and .= ' AND department.department_Id="' . $department_Id . '"';
    }

    if (($_POST['program_Id']) != 'All') {
        $and .= ' AND program.program_Id="' . $program_Id . '"';
    }


    if ($_POST['semester'] != 'All') {
        $and .= ' AND student.semester="' . $semester . '"';
    }

    //The above query will look like..

    // $filter_stud_det="SELECT student_Id,roll_No,department.name,program_Name,semester FROM student,department,program where student.program_Id=program.program_Id 
    // AND program.department_Id=department.department_Id
    // AND student.program_Id=$program_Id
    // AND program.department_Id=$department_Id
    // AND student.semester=$semester";

    $filter_query = $query . '' . $where . '' . $and;

    $result = $conn->query($filter_query);
    //Data is coming
    if ($result->num_rows > 0) {
        $r = "";
        while ($row = $result->fetch_assoc()) {

            $student_Id = $row["student_Id"];
            $roll_No = $row["roll_No"];
            $department = $row["name"];
            $program_Name = $row["program_Name"];
            $semester = $row["semester"];


            // Filter the Student based on Selected filter
            $r = $r . '<tr>
                    <td>' . $roll_No . '</td>
                    <td>' . ucwords($department) . '</td>
                    <td>' . ucwords($program_Name) . '</td>
                    <td>' . ucwords($semester) . '</td>
                    <td><input type="checkbox" name="student_Ids[]" value="' . $student_Id . '" ></td></tr>';
        }
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
                            <h1>Course Taught > Selected Students</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="Selected_Students" class="" style="width:100%">
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
                                    echo $selected_students;
                                    ?>
                                </tbody>
                            </table>

                            <div class="row mt-4 p-2">
                                <div class="col-md-9"></div>
                                <div class="col-md-1">
                                    <button type="button" id="modify_feedback" class="btn btn-primary" class="addAttr"
                                        data-toggle="modal" data-target="#modify" data-cc="<?php echo $course_code ?>"
                                        data-cn="<?php echo $course_name ?>"
                                        data-closing_date="<?php echo $closing_date ?>">
                                        Modify
                                    </button></td>

                                    <!-- Modal -->
                                    <div id="modify" class="modal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Modify Feedback
                                                        Duration</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post"
                                                        action="modify-feedback.php?course_Taught_Id=<?php echo $_GET['course_Taught_Id'] ?>">
                                                        <div class="card-body">
                                                            <div class=" form-group">
                                                                <label for="course_code">Course Code</label>
                                                                <input type="text" class="form-control"
                                                                    name="course_code" id="course_code"
                                                                    readonly="readonly">
                                                            </div>
                                                            <div class=" form-group">
                                                                <label for="course_name">Course Name</label>
                                                                <input type="text" class="form-control"
                                                                    name="course_name" id="course_name"
                                                                    readonly="readonly">
                                                            </div>
                                                            <div class=" form-group">
                                                                <label for="course_name">Closing Date</label>
                                                                <input type="text" class="form-control"
                                                                    name="closing date" id="closing_date"
                                                                    readonly="readonly">
                                                            </div>

                                                            <div class=" form-group">
                                                                <label for="course_name">Update Closing Date</label><br>
                                                                <input type="date" class="form-control"
                                                                    name="closing_date" id="closing_date" />
                                                            </div>
                                                            <div class="card-footer">
                                                                <button type="submit" name="modify-feedback"
                                                                    class="btn btn-primary">Update</button>
                                                            </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-danger" id="stop_feedback" style="width: 100%;"
                                    data-course_taught_id="<?php echo $_GET['course_Taught_Id']; ?>"
                                    data-teacher_id="<?php echo $teacher_Id; ?>">
                                    Stop
                                </button>
                            </div>
                            <div class="col-md-1">
                                <button type="button" id="publish-feed" class="btn btn-success" class="addAttr"
                                    data-toggle="modal" data-target="#addModal" data-cc="<?php echo $course_code; ?>"
                                    data-cn="<?php echo $course_name; ?>">
                                    Publish
                                </button>
                                </td>
                                <!-- Modal -->
                                <div id="addModal" class="modal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Publish</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post"
                                                    action="publish-feedback.php?course_Taught_Id=<?php echo $_GET['course_Taught_Id'] ?>">
                                                    <div class="card-body">
                                                        <div class=" form-group">

                                                            <label for="course_code">Course Code</label>
                                                            <input type="text" class="form-control" name="course_code"
                                                                id="pub-course_code" readonly="readonly">
                                                        </div>
                                                        <div class=" form-group">
                                                            <label for="course_name">Course Name</label>
                                                            <input type="text" class="form-control" name="course_name"
                                                                id="pub-course_name" readonly="readonly">
                                                        </div>

                                                        <div class=" form-group">
                                                            <label for="starting_data">Starting Date</label><br>
                                                            <input type="date" class="form-control" name="starting_date"
                                                                id="pub-starting_date" required />
                                                        </div>
                                                        <div class=" form-group">
                                                            <label for="closing_data">Closing Date</label><br>
                                                            <input type="date" class="form-control" name="closing_date"
                                                                id="pub-closing_date" />
                                                        </div>
                                                        <div class="card-footer">
                                                            <button type="submit" name="publish-feedback"
                                                                class="btn btn-primary">Publish</button>
                                                        </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            <form method="POST" action="issue-feedback.php?course_Taught_Id=<?php echo $_GET['course_Taught_Id'] ?>">
                <div class="row mb-2">
                    <div class="col-md-3">
                        <div>
                            <label>Department: </label>
                            <select style="height:2.5rem;width:100%;" class="form-select form-select-lg mb-3"
                                aria-label=".form-select-lg example" name="department_Id">
                                <option selected>All</option>
                                <?php
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
                    </div>
                    <div class="col-md-5">
                        <div>
                            <label>Programme: </label>

                            <select style="height:2.5rem;width:100%;" class="form-select form-select-lg mb-3"
                                aria-label=".form-select-lg example" name="program_Id">
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
                                aria-label=".form-select-lg example" name="semester">
                                <option selected>All</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2 d-flex align-items-center" style="margin-top: 1rem;">
                        <div>
                            <button name="filter_stud" class="btn btn-success">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <form method="POST" action="course-taken.php?course_Taught_Id=<?php echo $_GET['course_Taught_Id'] ?>">
                <div class="row">
                    <div class="col-md-12">
                        <table id="all_students" class="display" style="width:100%">
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

                                //If search is pressed then update the table
                                if (isset($_POST['filter_stud'])) {
                                    echo $r;
                                } else {
                                    echo $r;
                                }

                                ?>
                            </tbody>

                        </table>
                        <div class="row mt-4 p-2">
                            <div class="col-md-2 offset-md-5">
                                <button type="submit" name="stud_sel_sub" class="btn btn-primary">Save Selected</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
    </section>
    <!-- /.content-wrapper -->

    <!-- Footer -->
    <?php include './footer.php' ?>
    </section>
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

    <!-- Publish feedback based on Click -->
    <script>
    $("#publish-feed").on("click", function() {
        var cc = $(this).data('cc');
        var cn = $(this).data('cn');
        $('#pub-course_code').val(cc);
        $('#pub-course_name').val(cn);

    });
    </script>


    <!-- Update feedback based on Click and fill the course code ansd course name -->
    <script>
    $("#modify_feedback").on("click", function() {
        var cc = $(this).data('cc');
        var cn = $(this).data('cn');
        var closing_date = $(this).data('closing_date')

        $('#course_code').val(cc);
        $('#course_name').val(cn);
        $('#closing_date').val(closing_date)
    });
    </script>




    <!-- Page specific script -->
    <script>
    /* Initialization of datatable */
    var myTable = "";
    $(document).ready(function() {
        myTable = $('#all_students').DataTable({});
    });

    $(document).ready(function() {
        $('#Selected_Students').DataTable({});
    });

    $("#stop_feedback").on("click", function() {
        var course_Taught_Id = $(this).data('course_taught_id');
        var issued_By = $(this).data('teacher_id');


        $.ajax({
            type: "POST",
            url: "stop-feedback.php",
            data: {
                'course_Taught_Id': course_Taught_Id,
                'issued_By': issued_By
            },
            success: function(result) {
                alert("Successfuly Stopped receiving feedback..");
                // window.location.reload();
            },
            error: function(result) {
                alert('error');
            }
        });
    });

    $("#del_sel").on("click", function() {
        var course_Taught_Id = $(this).data('course_taught_id');
        var student_Id = $(this).data('student_id');

        console.log(student_Id);

        $.ajax({
            type: "POST",
            url: "drop_sel_stud.php",
            data: {
                'course_Taught_Id': course_Taught_Id,
                'student_Id': student_Id
            },
            success: function(result) {
                alert("Successfuly Deleted");
                window.location.reload();
            },
            error: function(result) {
                alert('error');
            }
        });
    });
    </script>

</body>

</html>