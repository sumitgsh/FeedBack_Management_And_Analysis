<?php
error_reporting(0);
session_start();
if (isset($_SESSION['success']) && isset($_SESSION['roll_No'])) {
    $check = "SELECT `student_Id` FROM `student` WHERE program_Id IS NULL";
    $result = $conn->query($check);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($_SESSION['student_Id'] == $row['student_Id']) {
                header("Location: complete-profile.php");
            }
        }
    }
}