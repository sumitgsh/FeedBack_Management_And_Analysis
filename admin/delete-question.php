<?php
if (isset($_POST['delete'])) {
    include '../includes/conn.php';
    $question_Id = $_POST['delete'];
    $sqlQuestionCat = "DELETE FROM `questioncategory` WHERE question_Id=$question_Id ";
    $conn->query($sqlQuestionCat);
    $sqlQuestion = "DELETE FROM `question` WHERE question_Id=$question_Id ";
    if ($conn->query($sqlQuestion) == TRUE) {
        echo '1';
    } else {
        echo '0';
    }
}
?>