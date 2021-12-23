<?php

include '../includes/conn.php';

$course_Taught_Id = $_POST["course_Taught_Id"];
$issued_By = $_POST["issued_By"];

$sql="UPDATE feedback_receiveables SET status='stopped' where issued_By='$issued_By' AND issuer_Domain='$course_Taught_Id'";

if ($conn->query($sql) === TRUE) 
{
	echo "1";
} else {
	echo "0";
}

?>
