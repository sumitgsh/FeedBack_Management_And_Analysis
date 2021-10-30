<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Question</title>

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
include '../includes/conn.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $message = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include '../includes/conn.php';
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            if (empty($_POST["question"]) || (empty($_POST["alumni"]) && empty($_POST["employeer"]) && empty($_POST["parent"]) && empty($_POST["student"]) && empty($_POST["teacher"]))) {
                echo "error";
                die();
            } else {
                $question_Id = $_POST["question_Id"];
                $question = $_POST["question"];
                $question_Type = $_POST["question_Type"];
                $alumni =  isset($_POST['alumni']) ? $_POST["alumni"] : "";
                $employeer = isset($_POST['emoloyeer']) ? $_POST["employeer"] : "";
                $parent = isset($_POST['parent']) ? $_POST["parent"] : "";
                $student = isset($_POST['student']) ? $_POST["student"] : "";
                $teacher = isset($_POST['teacher']) ? $_POST["teacher"] : "";

                $a = array($alumni, $employeer, $parent, $student, $teacher);
                try {
                    $sql = "UPDATE `question` SET`question`='$question',`question_Type`='$question_Type' WHERE  `question_Id`=$question_Id ";
                    if ($conn->query($sql) === TRUE) {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom:0;border-radius:0;">
                <strong>Question </strong> Successfully Updated !!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
                    } else {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-bottom:0;border-radius:0;">
                <strong>Failed Try Again!!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
                    }
                    $sqlCat = "DELETE * FROM `questioncategory` WHERE question_Id`=$question_Id ";
                    $conn->query($sqlCat);

                    foreach ($a as $value) {
                        if (!empty($value)) {
                            $questioncategory = "INSERT INTO `questioncategory`(`category_Id`, `question_Id`) VALUES ('$value','$question_Id')";
                            $conn->query($questioncategory);
                        }
                    }
                } catch (Exception $e) {
                    //throw $th;
                    echo $e;
                    echo "exp";
                }
            }
        }
    }

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
                <td><button type="button" class="btn btn-primary" class="addAttr" data-toggle="modal" data-target="#addModal" 
                data-id="' . $question_Id . '" data-question="' . $question . '" data-qt="' . $question_Type . '"
                 data-alumni="' . $category_Id['alumni'] . '" data-employer="' . $category_Id['employer'] . '"data-student="
                ' . $category_Id['student'] . '"data-parent="' . $category_Id['parent'] . '"data-teacher="' . $category_Id['teacher'] . '"> Edit</button></td>
            </tr>';
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
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Question add check box</h1>
                        </div>
                    </div>
                    <?php echo $message; ?>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="tableID" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Question</th>
                                        <th>Question Type</th>
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


    <!-- Modal -->
    <div id="addModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Question</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="question_Id">Question Id</label>
                                <input type="text" class="form-control" name="question_Id" id="question_Id" required>
                            </div>
                            <div class="form-group">
                                <label for="question">Question</label>
                                <input type="text" class="form-control" name="question" id="question" required>
                            </div>

                            <div class="form-group">
                                <label for="question_Type">Question Type</label><br>
                                <select name="question_Type" id="question_Type"
                                    class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger"
                                    style="width: 100%;">
                                    <option value="rating">Rating</option>
                                    <option value="long_Answer">Long Answer</option>
                                </select><br>
                            </div>
                            <div class="form-group">
                                <label for="question_Category">Question Category</label><br>
                                <input type="checkbox" id="alumni" name="alumni" value="alumni">
                                <label for="alumni"> Alumni</label><br>
                                <input type="checkbox" name="employeer" value="employer">
                                <label for="employer"> Employer</label><br>
                                <input type="checkbox" name="parent" value="parent">
                                <label for="parent"> Parent</label><br>
                                <input type="checkbox" name="student" value="student">
                                <label for="student"> Student</label><br>
                                <input type="checkbox" name="teacher" value="teacher">
                                <label for="teacher"> Teacher</label>
                            </div>

                            <div class="card-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


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