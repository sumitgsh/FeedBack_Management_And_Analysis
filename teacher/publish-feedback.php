
<?php
include '../includes/conn.php';
include './check.php';

$course_Taught_Id=$_GET['course_Taught_Id'];

//Publish Feedback if button is Submitted 

if(isset($_POST['publish-feedback']))
{

 $issue_date=$_POST['starting_date'];
 $closing_date=$_POST['closing_date'];
 $status="published";
 $issued_For="student";
 $issued_By=  $teacher_Id ;
 $issuer_Domian=$course_Taught_Id;

 $flag=true;
 $sql = "INSERT INTO feedback_receiveables(`issue_date`, `closing_date`, `status`, `issued_For`, `Issued_By`, `issuer_Domain`) 
                VALUES('".$issue_date."','".$closing_date."','".$status."','".$issued_For."','".$issued_By."','".$issuer_Domian."')";
                
    $result=mysqli_query($conn,$sql);
    if (!$result) {
        $flag=false;
        echo "Error occured!!";
    }


    if($flag)
    {
        echo "<script>alert('Feedback Issued!!');
        window.location.replace('issue-feedback.php?course_Taught_Id=".$course_Taught_Id."');    
        </script>";
   
    } 
    
}

?>