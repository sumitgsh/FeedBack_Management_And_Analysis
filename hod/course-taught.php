<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Taught</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- Datatable plugin CSS file -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />



</head>

<?php
include '../includes/conn.php';
include "./check.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // check for course  teacher
        $cid = $_POST['course_taught_id'];
        $teacher_Id = $_POST['teacher_Id'];
        $course_Code = $_POST['course_Code'];
        $ses = $_POST['ses'];
        $year = $_POST['year'];
        $sql = "UPDATE `coursetaught` SET `teacher_Id`='$teacher_Id',`course_Code`=' $course_Code',`session`='$ses',`year`=$year WHERE `course_Taught_Id`=$cid";
        if ($conn->query($sql) === TRUE) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom:0;border-radius:0;">
                <strong>Course </strong> Taught Updated !!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
        } else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-bottom:0;border-radius:0;">
                <strong>Course </strong> Taught Update Fail !!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
        }
    }
    $course_Taught = "SELECT course_Name,course.course_Code,department.name as dn,teacher.name as tn,`session`,year  FROM `course`,teacher,department,coursetaught WHERE department.department_Id='$department_Id' AND course.course_Code=coursetaught.course_Code AND teacher.teacher_Id=coursetaught.teacher_Id";
    $result = $conn->query($course_Taught);
    $r = "";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $course_Taught_Id  = $row["course_Taught_Id"];
            $teacher_Id = $row["teacher_Id"];
            $course_Code = $row["course_Code"];
            $year = $row["year"];
            $session = $row["session"];
            $course = "";
            $courseResult = $conn->query($course);
            //if ($courseResult->num_rows > 0) {
            // while ($rowCourse = $courseResult->fetch_assoc()) {
            $course_Name = $row['course_Name'];
            $course_Code = $row['course_Code'];
            $name = $row['tn'];
            $department_Id = $row['department_Id'];
            $dept_Name = $row["dn"];
            //}
            //}
            $r = $r . '<tr>
                <td>' . $course_Name . '</td>
                <td>' . $name . '</td>
                <td>' . $dept_Name . '</td>
                <td>' . ucwords($session) . '</td>
                <td>' . $year . '</td>
                <td><button type="button" class="btn btn-primary" class="addAttr" data-toggle="modal" data-target="#addModal" 
                data-teacher="' . $teacher_Id . '" data-course_Code="' . $course_Code . '" data-teacher-name="' . $name . '"
                 data-department_Id="' . $department_Id . '" data-department_Name="' . $dept_Name . '" data-session="' . $session . '" data-year="' . $year . '" data-cid="' . $course_Taught_Id . '"> Edit</button></td>
            </tr><br>';
        }
    }
}

?>

<body>
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
                    <div class="col-md-6">
                        <table id="tableID" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Course Name</th>
                                    <th>Teacher Name</th>
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
        $('#cid').val(cid);
        $('#teacher_Id').val(teacher_Id);
        $('#name').val(name);
        $('#ses').val(session);
        $('#department').val(department_Id);
        $('#year').val(year);
        $('#course_Code').val(course_Code);
    });
    </script>
    <!-- Modal -->
    <div id="addModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="card-body">
                            <div class=" form-group">
                                <label for="course_taught_id">Id</label>
                                <input type="number" class="form-control" name="course_taught_id" id="cid"
                                    readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label for="teacher_Id">Teacher</label>
                                <select class="form-control select2 select2-danger"
                                    data-dropdown-css-class="select2-danger" style="width: 100%;" name="teacher_Id"
                                    id="teacher_Id" required>

                                    <?php
                                    include '../includes/conn.php';
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    } else {
                                        $teacher = "SELECT `teacher_Id`, `name`FROM `teacher` WHERE `verified`=1 and `department_Id`='$department_Id'";
                                        $result = $conn->query($teacher);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<option value="' . $row['teacher_Id'] . '">' . $row["name"] . '</option>';
                                            }
                                        } else {
                                            echo '<option value=""></option>';
                                        }
                                    }


                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="course">Course</label>
                                <select class="form-control select2 select2-danger"
                                    data-dropdown-css-class="select2-danger" style="width: 100%;" name="course_Code"
                                    id="course_Code" required>

                                    <?php
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    } else {
                                        $course = "SELECT `course_Name`, `course_Code` FROM `course` where `department_Id`='$department_Id'";
                                        $result = $conn->query($course);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<option value="' . $row['course_Code'] . '">' . $row["course_Name"] . '</option>';
                                            }
                                        } else {
                                            echo '<option value=""></option>';
                                        }
                                    }


                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="session">Session</label>
                                <select class="form-control select2 select2-danger"
                                    data-dropdown-css-class="select2-danger" style="width: 100%;" name="ses" id="ses">
                                    <option value="autumn">Autumn</option>
                                    <option value="spring">Spring</option>
                                </select>
                            </div>
                            <div class=" form-group">
                                <label for="year">Year</label>
                                <input type="number" class="form-control" name="year" id="year" min="2000" max="2099"
                                    step="1" value="2021" required>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>