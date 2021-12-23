<?php
error_reporting(1);
include "./check.php";
include "../includes/conn.php";
$total = 0;
$c = "SELECT COUNT(*) as total FROM (SELECT DISTINCT `feedback_id`, `feedbacker_id` FROM `feedback`,feedback_receiveables WHERE feedback_R_Id=feedback_id AND issued_By='$teacher_Id') as t";
$result = $conn->query($c);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $total = $row['total'];
    }
}
echo $total;
?>
<html>

</html>