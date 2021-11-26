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
</head>

<?php
include '../includes/conn.php';
include './check.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $feedback = "SELECT `feedback_R_Id`, `issue_date`, `closing_date`,`issued_For` FROM `feedback_receiveables` WHERE issued_By='super' and issued_For='employer' and `status`='published' ORDER BY closing_date DESC";
    $result = $conn->query($feedback);
    $r = "";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $issue_date = $row["issue_date"];
            $closing_date = $row["closing_date"];
            $id = $row["feedback_R_Id"];
            $issued_For = $row["issued_For"];

            $date = date("Y-m-d");
            if ($date >= $issue_date & $date <= $closing_date) {
                $check = "SELECT `feedback_id`, `feedbacker_id` FROM `feedback` WHERE feedbacker_id=$employers_Id and feedback_id=$id";
                $rCheck = $conn->query($check);
                if ($result->num_rows > 0) {
                    $b = '<a class="btn btn-info" href="#">Feedback Submited</a></td>';
                } else {
                    $b = '<a class="btn btn-primary" href="/feedback/FeedBack_Management_And_Analysis/employer/feedback-employer.php?id=' . $id . '&issued_For=' . $issued_For . '">Provide Feedback</a></td>';
                }
            } else {
                $b = '<button type="button" class="btn btn-primary" disabled>Unavailable</button';
            }
            $r = $r . '<tr>
                <td>' . $id . '</td>
                <td>' . $issue_date . '</td>
                <td>' . $closing_date . '</td>
                <td>' . $b . '</tr><br>';
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