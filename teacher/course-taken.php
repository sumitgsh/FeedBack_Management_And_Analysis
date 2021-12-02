<?php

include '../includes/conn.php';
echo "<pre>";


// [] get the Student Ids 
// [] get the course_taught_id from the URI
// [] update the course taken table

$course_Taught_Id=$_GET['course_Taught_Id'];
$student_Ids=$_POST["student_Ids"];

var_dump( $student_Ids);

// // Insert record
$flag=true;
foreach($student_Ids as $key=>$value){

    $student_Id = $value;
 
    $sql = "INSERT INTO coursetaken(course_Taught_Id,student_Id) VALUES('".$course_Taught_Id."','".$student_Id."')";
    $result=mysqli_query($conn,$sql);
    if (!$result) {
        $flag=false;
        echo "Error occured!!";
    }
 }

 if($flag)
 {
    header("Location:issue-feedback.php?course_Taught_Id=".$course_Taught_Id);
 }


exit;


?>