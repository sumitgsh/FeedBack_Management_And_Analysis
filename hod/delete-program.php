<?php
if (isset($_POST['delete'])) {
    include '../includes/conn.php';
    $program_Id = $_POST['delete'];
    $sqlProgram = "DELETE FROM `program` WHERE program_Id='$program_Id' ";
    if ($conn->query($sqlProgram) == TRUE) {
        echo '1';
    } else {
        echo '0';
    }
}
?>