<?php

include '../includes/conn.php';


$question = "SELECT `question_Id`, `question`, `question_Type` FROM `question` ";
$result = $conn->query($question);
$r = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        $question_Id = $row["question_Id"];
        $question = $row["question"];
        $question_Type = $row["question_Type"];
        $questionCat = "SELECT `category_Id`, `question_Id` FROM `questioncategory` WHERE `question_Id`=$question_Id";
        $dResult = $conn->query($questionCat);
        $category_Id = array('alumni' => '', 'employer' => '', 'student' => '', 'parent' => '', 'teacher' => '');
        if ($dResult->num_rows > 0) {
            while ($row = $dResult->fetch_assoc()) {
                $category_Id[$row['category_Id']] = $row['category_Id'];
            }
        }
        $r = $r . '<tr>
                <td>' . $question_Id . '</td>
                <td>' . ucwords($question) . '</td>
                <td>' . ucwords($question_Type) . '</td>
                <td><input type="checkbox" value="' . $question_Id . '" ></td></tr>';
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
                                    <tr>
                                        <td>CSM20036</td>
                                        <td>CSE</td>
                                        <td>MCA</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td>CSM20036</td>
                                        <td>CSE</td>
                                        <td>MCA</td>
                                        <td>5</td>
                                    </tr>
                                </tbody>
                            </table>


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
                    <div class="row mb-2">
                        <div class="col-md-2">
                            <h5>Filter By:<h5>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <label>Department: </label>
                                <select style="height:2.5rem;" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                    <option selected>All</option>
                                    <option value="1">CSE</option>
                                    <option value="2">MCJ</option>
                                    <option value="3">MBBT</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div>
                                <label>Programme: </label>
                                <select style="height:2.5rem;" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                    <option selected>All</option>
                                    <option value="1">CSE</option>
                                    <option value="2">MCJ</option>
                                    <option value="3">MBBT</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="filter_field">
                                <label>Semester: </label>
                                <select style="height:2.5rem;" class="form-select form-select-lg" aria-label=".form-select-lg example">
                                    <option selected>All</option>
                                    <option value="1">CSE</option>
                                    <option value="2">MCJ</option>
                                    <option value="3">MBBT</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div>
                              <button class="btn btn-success">Search</button>
                            </div>
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
                                        <th>Roll No</th>
                                        <th>Department</th>
                                        <th>Programme</th>
                                        <th>Semester</th>
                                        <th></th>
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
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Footer -->
        <?php include './footer.php' ?>
    </div>
    <!-- ./wrapper -->



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