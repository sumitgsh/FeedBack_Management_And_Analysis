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
include "./check.php";
//$student_Id = 8;
//$department_Id = 'cse';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $semester = $_POST['semester'];
        $program_Id = $_POST['program'];
        $parent_Name =  $_POST['pName'];
        $parent_Phone_No = $_POST['parent_Phone_No'];
        $relation = $_POST['relation'];
        $updateStudent = "UPDATE `student` SET `program_Id`='$program_Id',`parent_Phone_No`=$parent_Phone_No,`parent_Name`='$parent_Name',
        `semester`=$semester,`relation`='$relation'WHERE student_Id=$student_Id";
        if ($conn->query($updateStudent) == true) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom:0;border-radius:0;">
                <strong>Profile </strong> Successfully Updated !!
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
            echo $conn->error . "  " . $updateStudent;
        }
    }
}
$student = "SELECT `roll_No`, `name`, `email`, student.program_Id, `parent_Phone_No`, `parent_Name`, `verified`, `semester`, `relation`,`department_id` FROM `student`,`program` where student_Id=$student_Id AND program.program_Id=student.program_Id";
$result = $conn->query($student);
$r = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $name = empty($row['name']) ? "" : $row['name'];
        $roll = empty($row['roll_No']) ? "" : $row['roll_No'];
        $email = empty($row['email']) ? "" : $row['email'];
        $semester = empty($row['semester']) ? "" : $row['semester'];
        $program_Id = empty($row['program_Id']) ? "" : $row['program_Id'];
        $department_Id = empty($row['department_id']) ? "" : $row['department_id'];
        //echo $department_Id;
        $parent_Name = empty($row['parent_Name']) ? "" : $row['parent_Name'];
        $parent_Phone_No = empty($row['parent_Phone_No']) ? "" : $row['parent_Phone_No'];
        $relation = empty($row['relation']) ? "" : $row['relation'];
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
                                            <label for="name">Name</label><br>
                                            <input type="text" class="form-control" name="name" readonly
                                                value="<?php echo $name ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="Roll">Roll Number</label><br>
                                            <input type="text" class="form-control" name="roll" readonly
                                                value="<?php echo $roll ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label><br>
                                            <input type="text" class="form-control" name="email"
                                                value="<?php echo $email ?>" readonly required>
                                        </div>
                                        <div class="form-group">
                                            <label for="question">Semester</label><br>
                                            <select class="form-control select2 select2-danger"
                                                data-dropdown-css-class="select2-danger" style="width: 100%;"
                                                name="semester" id="semester" required>
                                                <option value="1" <?php if ($semester == 1) echo "selected"; ?>>1
                                                </option>
                                                <option value="2" <?php if ($semester == 2) echo "selected"; ?>>2
                                                </option>
                                                <option value="3" <?php if ($semester == 3) echo "selected"; ?>>3
                                                </option>
                                                <option value="4" <?php if ($semester == 4) echo "selected"; ?>>4
                                                </option>
                                                <option value="5" <?php if ($semester == 5) echo "selected"; ?>>5
                                                </option>
                                                <option value="6" <?php if ($semester == 6) echo "selected"; ?>>6
                                                </option>
                                                <option value="7" <?php if ($semester == 7) echo "selected"; ?>>7
                                                </option>
                                                <option value="8" <?php if ($semester == 8) echo "selected"; ?>>8
                                                </option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="program">Program</label><br>
                                            <select class="form-control select2 select2-danger"
                                                data-dropdown-css-class="select2-danger" style="width: 100%;"
                                                name="program" id="program" required>
                                                <?php
                                                $programid = "SELECT `program_Id`, `program_Name` FROM `program` WHERE department_Id='$department_Id'";
                                                $result = $conn->query($programid);
                                                $pid = "";
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        if ($program_Id == $row["program_Id"])
                                                            echo '<option value="' . $row["program_Id"] . '" selected>' . $row["program_Name"] . '</option>';
                                                        else
                                                            echo '<option value="' . $row["program_Id"] . '">' . $row["program_Name"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="pName">Parent Name</label><br>
                                            <input type="text" class="form-control" name="pName"
                                                value="<?php echo $parent_Name ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="parent_Phone_No">Parent Phone Number</label><br>
                                            <input type="text" class="form-control" name="parent_Phone_No"
                                                value="<?php echo $parent_Phone_No ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="relation">Relation</label><br>
                                            <input type="text" class="form-control" name="relation"
                                                value="<?php echo $relation ?>" required>
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