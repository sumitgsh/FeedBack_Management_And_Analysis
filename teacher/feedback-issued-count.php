<?php
error_reporting(1);
include "./check.php";
include "../includes/conn.php";
$total = 0;
$c = "SELECT COUNT(`issuer_Domain`) as t FROM `feedback_receiveables` WHERE issued_By='$teacher_Id'";
$result = $conn->query($c);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $total = $row['t'];
    }
}
echo $total;
?>
<html>

</html>