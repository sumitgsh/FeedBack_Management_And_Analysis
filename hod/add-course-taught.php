<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course Taught</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<?php
include "./check.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../includes/conn.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $teacher_Id = $_POST["teacher_Id"];
        $course_Code = $_POST["course_Code"];
        $ses = $_POST["ses"];
        $year = $_POST["year"];
        try {
            $sql = "INSERT INTO `coursetaught`(`teacher_Id`, `course_Code`, `session`, `year`) VALUES ('$teacher_Id','$course_Code','$ses',$year)";
            if ($conn->query($sql) === TRUE) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom:0;border-radius:0;">
                <strong>Course </strong> Taught Added !!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            } else {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-bottom:0;border-radius:0;">
                <strong>Failed </strong>To Add Course Taught !!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
        } catch (Exception $e) {
            //throw $th;
            // echo $e;
            //echo "exp";
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
                        <h1>Add Course Taught</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="teacher_Id">Teacher</label>
                                    <select class="form-control select2 select2-danger"
                                        data-dropdown-css-class="select2-danger" style="width: 100%;" name="teacher_Id"
                                        required>

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
                                        required>

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
                                        data-dropdown-css-class="select2-danger" style="width: 100%;" name="ses">
                                        <option value="autumn">Autumn</option>
                                        <option value="spring">Spring</option>
                                    </select>
                                </div>
                                <div class=" form-group">
                                    <label for="year">Year</label>
                                    <input type="number" class="form-control" name="year" min="2000" max="2099" step="1"
                                        value="2021" required>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
</body>

</html>