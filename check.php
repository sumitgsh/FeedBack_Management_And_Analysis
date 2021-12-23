<?php
session_start();
if (isset($_SESSION['success']) && isset($_SESSION['roll_No'])) {
    $roll_No = $_SESSION['roll_No'];
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $program_Id = $_SESSION['program_Id'];
    $student_Id = $_SESSION['student_Id'];
} else {
    echo '<link rel="stylesheet" type="text/css" href="../assets/css/message.css">
        <div class="messageBody"><div>Your Session Has been Expired</div>
        <div><a href="./login.php">Back To Login</a></div></div>';
    exit();
}

?>
<html>

</html>