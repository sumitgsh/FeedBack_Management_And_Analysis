<?php

include './includes/conn.php';

$email = $_GET["email"];

$result = mysqli_query($conn, "SELECT email from student where email = '$email'");

if (mysqli_num_rows($result) > 0) {
	echo "1";
} else {
	echo "0";
}
?>
