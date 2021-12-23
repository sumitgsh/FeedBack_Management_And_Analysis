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
var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                labels: ''Your prerequisite knowledge was sufficient for understanding this course?','The course was relevant in relation to the program of study.','Topics/ units were logically sequenced in the syllabus.','The course is suitable in terms of employability.','Instructor was well prepared for classes.',],datasets: [
                        {
                        data:[5,3,3,4,2,],
                borderColor: ''Aqua','BlueViolet','Chocolate','CornflowerBlue','Cyan',],
                backgroundColor: ''Aqua','BlueViolet','Chocolate','CornflowerBlue','Cyan',}],
                },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                beginAtZero:true,
                                max: 5
                                }
                            }]
                        }
                    }
                }); 