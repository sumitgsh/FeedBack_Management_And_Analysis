<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FeedBack Management| Admin Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../includes/conn.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        if (empty($_POST["question"]) || (empty($_POST["alumni"]) && empty($_POST["employer"]) && empty($_POST["parent"]) && empty($_POST["student"]) && empty($_POST["teacher"]))) {
            echo "error";
            die();
        } else {
            $question = $_POST["question"];
            $question_Type = $_POST["question_Type"];
            $alumni =  isset($_POST['alumni']) ? $_POST["alumni"] : "";
            $employer = isset($_POST['employer']) ? $_POST["employer"] : "";
            $parent = isset($_POST['parent']) ? $_POST["parent"] : "";
            $student = isset($_POST['student']) ? $_POST["student"] : "";
            $teacher = isset($_POST['teacher']) ? $_POST["teacher"] : "";

            $a = array($alumni, $employer, $parent, $student, $teacher);
            try {
                $sql = "INSERT INTO `question`(`question`, `question_Type`) VALUES ('$question','$question_Type')";
                $conn->query($sql);
                $id = $conn->insert_id;;
                foreach ($a as $value) {
                    if (!empty($value)) {
                        $sql = "INSERT INTO `questioncategory`(`category_Id`, `question_Id`) VALUES ('$value','$id')";
                        $conn->query($sql);
                        echo $conn->error;
                    }
                }
                echo "Qustion Added";
            } catch (Exception $e) {
                //throw $th;
                echo $e;
                echo "exp";
            }
        }
    }
}
?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include './main-nav.php' ?>
        <!-- Navbar -->

        <!-- Main Sidebar Container -->
        <?php include './main-sidebar.php' ?>
        <!-- Sidebar -->


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Questions</h1>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <div class="card-title">
                                        Add Questions
                                    </div>
                                </div>
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="question">Type your Question ?</label><br>
                                            <textarea id="question" class="form-control" name="question" rows="4"
                                                cols="50" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="question_Type">Question Type</label><br>
                                            <select name="question_Type" id="question_Type"
                                                class="form-control select2 select2-danger"
                                                data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                <option value="rating">Rating</option>
                                                <option value="long_Answer">Long Answer</option>
                                            </select><br>
                                        </div>
                                        <div class="form-group">
                                            <label for="question_Category">Question Category</label><br>
                                            <input type="checkbox" name="alumni" value="alumni">
                                            <label for="alumni"> Alumni</label><br>
                                            <input type="checkbox" name="employer" value="employer">
                                            <label for="employer"> Employer</label><br>
                                            <input type="checkbox" name="parent" value="parent">
                                            <label for="parent"> Parent</label><br>
                                            <input type="checkbox" name="student" value="student">
                                            <label for="student"> Student</label><br>
                                            <input type="checkbox" name="teacher" value="teacher">
                                            <label for="teacher"> Teacher</label>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include './footer.php' ?>>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
    $(function() {
        bsCustomFileInput.init();
    });
    </script>
</body>

</html>