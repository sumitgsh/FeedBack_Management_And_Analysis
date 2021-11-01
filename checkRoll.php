<?php

include './includes/conn.php';

$roll_No = $_GET["roll_No"];

$result = mysqli_query($conn, "SELECT roll_No from student where roll_No = '$roll_No'");

if (mysqli_num_rows($result) > 0) {
	echo "1";
} else {
	echo "0";
}
?>
