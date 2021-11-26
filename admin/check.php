<?php
session_start();
if (isset($_SESSION['success']) && isset($_SESSION['role']) && $_SESSION['role'] == 'superadmin') {
    $teacher_Id = $_SESSION['teacher_Id'];
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
} else {
    echo '<link rel="stylesheet" type="text/css" href="../assets/css/message.css">
        <div class="messageBody"><div>Your Session Has been Expired</div>
        <div><a href="./login.php">Back To Login</a></div></div>';
    exit();
}

?>
<html>

</html>