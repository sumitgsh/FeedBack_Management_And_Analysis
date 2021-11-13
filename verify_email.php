
<!DOCTYPE html>
<html>
	<head>
	<title>User Email Verification</title>
	</head>
<body>

<?php

include './includes/conn.php';

if (isset($_GET['token'])) {

    $token = $_GET['token'];
    $sql = "SELECT * FROM student WHERE token='$token' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $query = "UPDATE student SET verified=1 WHERE token='$token'";

        if (mysqli_query($conn, $query)) {
            $msg = "Your email address has been verified successfully";
            echo $msg;
            exit(0);
        }
    } else {
        $msg="User not found!";
    }
} else {
		$msg="No token provided!";
}
?>
<p><?php echo $msg; ?></p>
</body>
</html>


