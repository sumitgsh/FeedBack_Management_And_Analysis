

<?php
include './includes/conn.php';

$department_Id=$_POST["department_Id"];

$sql ="SELECT * from program where department_Id='$department_Id'";
$result=mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0)
{
    while ($row = $result->fetch_assoc()) {
        echo '<option value="'.htmlentities($row["program_Id"]).'">'.htmlentities($row["program_Name"]).'</option>';
    }
}



?>