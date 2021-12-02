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
include './includes/conn.php';
//include './check.php';
$$student_Id = 8;
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $course_Taken = "SELECT department.name,course.course_Code,coursetaught.session,coursetaught.year,courseTaught.course_Taught_Id FROM `coursetaken`,`coursetaught`,`program`,`department`,`course` 
    WHERE coursetaken.course_Taught_Id=coursetaught.course_Taught_Id AND coursetaught.course_Code=course.course_Code AND course.department_Id=department.department_Id 
    AND coursetaken.student_Id=8";
    $result = $conn->query($course_Taken);
    $r = "";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $department  = $row["name"];
            $course_Code = $row["course_Code"];
            $year = $row["year"];
            $session = $row["session"];
            $course_Taught_Id = $row["course_Taught_Id"];
            $feedbackIssue = "SELECT `feedback_R_Id`, `issue_date`, `closing_date`, `status`,`issuer_Domain` FROM `feedback_receiveables` WHERE issuer_Domain='$course_Taught_Id'";
            $feedbackIssueResult = $conn->query($feedbackIssue);
            if ($feedbackIssueResult->num_rows > 0) {
                while ($rowFeedback = $feedbackIssueResult->fetch_assoc()) {
                    $feedback_R_Id = $row["feedback_R_Id"];
                    $status = $row["status"];
                }
            } else {
            }
            $r = $r . '<tr>
                <td>' . $course_Name . '</td>
                <td>' . $dept_Name . '</td>
                <td>' . ucwords($session) . '</td>
                <td>' . $year . '</td>
                <td><button type="button"   
                "> <a class="btn btn-primary" href="/feedback/FeedBack_Management_And_Analysis/teacher//issue-feedback.php?course_Taught_Id=' . $course_Taught_Id . '">Add Student</a> </button></td>
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
    });
    </script>
    </div>
    </div>
    </div>
    </div>
</body>

</html>