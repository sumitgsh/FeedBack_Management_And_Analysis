<?php
session_start();
if (isset($_SESSION['employers_Id']) && isset($_SESSION['organization_Name'])) {
    $employers_Id = $_SESSION['employers_Id'];
    $organization_Name = $_SESSION['organization_Name'];
    $email = $_SESSION['email'];
    $designation = $_SESSION['designation'];
} else {
    echo '<link rel="stylesheet" type="text/css" href="../assets/css/message.css">
        <div class="messageBody"><div>Your Session Has been Expired</div>
        <div><a href="./login.php">Back To Login</a></div></div>';
    exit();
}

?>
<html>

</html>