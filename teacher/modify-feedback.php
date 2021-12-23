


<?php
include '../includes/conn.php';
include './check.php';

$course_Taught_Id=$_GET['course_Taught_Id'];

//Modify  Feedback if button is Pressed 

if(isset($_POST['modify-feedback']))
{

 $closing_date=$_POST['closing_date'];
 $issued_By=  $teacher_Id ;
 $issuer_Domian=$course_Taught_Id;

 $flag=false;
// UPDATE feedback_receiveables SET closing_date='2021-12-22' where issued_By='CSE_01' AND issuer_Domain='1'
 $sql="UPDATE feedback_receiveables SET closing_date='$closing_date' where issued_By='$issued_By' AND issuer_Domain='$course_Taught_Id'";

 if ($conn->query($sql) === TRUE) 
 {
     $flag=true;
 } else {
     $flag=false;
     echo "Error Occured!!";
 }


    if($flag)
    {
        echo "<script>alert('Feedback Modified!!');
        window.location.replace('issue-feedback.php?course_Taught_Id=".$course_Taught_Id."');    
        </script>";
   
    } 
    
}

?>