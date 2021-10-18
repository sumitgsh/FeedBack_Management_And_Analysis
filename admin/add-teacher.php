<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Teacher</title>
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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="teacher_Id">Teacher Id</label>
        <br>
        <input type="text" name="teacher_Id" required>
        <br>
        <label for="name">Name</label>
        <br>
        <input type="text" name="name" required>
        <br>
        <label for="email">Email</label>
        <br>
        <input type="email" name="email" required>
        <br>
        <label for="department">Department</label>
        <br>
        <select name="department" id="department">
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
        </select><br>
        <label for="role">Role</label>
        <br>
        <select name="role" id="role">
            <option value="teacher">Teacher</option>
            <option value="hod">HOD</option>
        </select><br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>