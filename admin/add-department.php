<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Department</title>
</head>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../includes/conn.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $department_Id = strtolower($_POST["department_Id"]);
        $department_Name = ucwords(strtolower($_POST["department_Name"]));
        try {
            $sql = "INSERT INTO `department`(`department_Id`, `name`) VALUES ('$department_Id','$department_Name')";
            if ($conn->query($sql) === TRUE) {
                echo "Department Added";
            } else {
                echo "error";
            }
        } catch (Exception $e) {
            //throw $th;
            echo $e;
            echo "exp";
        }
    }
}
?>

<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="department_Id">Department Id</label><br>
        <input type="text" name="department_Id" required><br>
        <label for="department_Name">Department Name</label><br>
        <input type="text" name="department_Name" required><br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>