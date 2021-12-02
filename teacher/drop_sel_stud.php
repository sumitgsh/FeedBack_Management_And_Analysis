<?php

include '../includes/conn.php';

$course_Taught_Id = $_POST["course_Taught_Id"];
$student_Id = $_POST["student_Id"];

$result = mysqli_query($conn, "DELETE  from coursetaken where course_Taught_Id = '$course_Taught_Id' AND student_Id='$student_Id' ");

if (($result)) {
	echo "1";
} else {
	echo "0";
}

?>
