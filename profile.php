<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile| Student</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- jQuery library file -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js">
    </script>
</head>
<?php
include './includes/conn.php';
$department_Id = 'cse';
$student_Id = '8';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
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
                            <!-- <h1>Profile</h1> -->
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
                                        Student Profile
                                    </div>
                                </div>
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="question">Name</label><br>
                                            <input type="text" class="form-control" name="department_Id" readonly
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="question">Roll Number</label><br>
                                            <input type="text" class="form-control" name="department_Id" readonly
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="question">Email</label><br>
                                            <input type="text" class="form-control" name="department_Id" readonly
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="question">Program Id</label><br>
                                            <select class="form-control select2 select2-danger"
                                                data-dropdown-css-class="select2-danger" style="width: 100%;"
                                                name="department" id="department" required>
                                                <?php
                                                $programid = "SELECT `program_Id`, `program_Name` FROM `program` WHERE department_Id='$department_Id'";
                                                $result = $conn->query($programid);
                                                $pid = "";
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo '<option value="' . $row["program_Id"] . '">' . $row["program_Name"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="question">Semester</label><br>
                                            <input type="text" class="form-control" name="department_Id" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="question">Parent Name</label><br>
                                            <input type="text" class="form-control" name="department_Id" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="question">Parent Phone Number</label><br>
                                            <input type="text" class="form-control" name="department_Id" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="question">Relation</label><br>
                                            <input type="text" class="form-control" name="department_Id" required>
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


    <script>
    $(function() {
        bsCustomFileInput.init();
    });
    </script>
</body>

</html>