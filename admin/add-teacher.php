<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Teacher</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

</head>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../includes/conn.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        if (empty($_POST['teacher_Id']) || empty($_POST['name']) || empty($_POST['email']) || empty($_POST['department']) || empty($_POST['role'])) {
            echo "error";
            die();
        } else {
            $teacher_Id = $_POST['teacher_Id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $department_Id = $_POST['department'];
            $role = $_POST['role'];
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $password = password_hash(substr(str_shuffle($chars), 0, 8), PASSWORD_DEFAULT);
            $sql = "INSERT INTO `teacher`(`teacher_Id`, `name`, `email`, `department_Id`, `role`, `password`) VALUES ('$teacher_Id','$name','$email','$department_Id','$role','$password')";
            if ($conn->query($sql) === TRUE) {
                echo "teacher added";
            } else {
                echo $conn->error;
            }
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
                        <h1>Add Teacher</h1>
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
                                    <label for="teacher_Id">Teacher Id</label>
                                    <input type="text" class="form-control" name="teacher_Id" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="department">Department</label>
                                    <select class="form-control select2 select2-danger"
                                        data-dropdown-css-class="select2-danger" style="width: 100%;" name="department"
                                        id="department" required>
                                        <?php
                                        include '../includes/conn.php';
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

                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select class="form-control select2 select2-danger"
                                        data-dropdown-css-class="select2-danger" style="width: 100%;" name="course_Code"
                                        required>
                                        <option value="teacher">Teacher</option>
                                        <option value="hod">HOD</option>
                                    </select>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        </form>
</body>

</html>