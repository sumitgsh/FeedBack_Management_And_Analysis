<?php
error_reporting(1);
include "./check.php";
include "../includes/conn.php";
$total = 0;
$c = "SELECT COUNT(`course_Taught_Id`) as tcourse FROM `coursetaught` WHERE teacher_Id='$teacher_Id'";
$result = $conn->query($c);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $total = $row['tcourse'];
    }
}
echo $total;
?>
<html>

</html>