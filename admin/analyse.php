<?php

include '../includes/conn.php';
include './check.php';
include './analyse-sentiment.php';
$r = '';
// Show the Selected Students in the Dashboard after selecting based on student_ID
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $id = $_POST["id"];
        $type = $_POST["feedback_Type"];
        if ($type == 'rating') {
            if ($id == 'all') {
                $filter = "SELECT q.question_Id, `question`, `question_Type`,AVG(answer) as ans FROM `question`as q,`feedback_receiveables` as fr,`feedback` as f 
                WHERE question_Type='$type' and f.feedback_id=fr.feedback_R_Id and q.question_Id=f.question_Id GROUP BY q.question_Id";
            } else {
                $filter = "SELECT q.question_Id, `question`, `question_Type`,AVG(answer) as ans FROM `question`as q,`feedback_receiveables` as fr,`feedback` as f 
                WHERE question_Type='$type' and f.feedback_id=$id and q.question_Id=f.question_Id GROUP BY q.question_Id";
            }
            $result = $conn->query($filter);
            $color = array('Aqua', 'BlueViolet', 'Chocolate', 'CornflowerBlue', 'Cyan', 'DarkMagenta', 'DeepPink');
            $r = "<canvas id='myChart'></canvas>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js'></script>
            <script>
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
            labels:['Question'";
            $i = 0;
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $qId[$i] = $row['question_Id'];
                    $q[$i] = $row['question'];
                    $ans[$i] = $row['ans'];
                    $i = $i + 1;
                }
            }

            $r = $r .
                "],datasets: [";
            for ($j = 0; $j < sizeof($ans); $j++) {
                $red = 10 + $j * 5;
                $blue = 9 + $j * 5;
                $green = 32 + $j * 3;
                $r = $r . "{
                    data:[" . $ans[$j] . "],
                    label: '" . $q[$j] . "',
                    borderColor:'" . $color[$j] . "',
                    backgroundColor:'" . $color[$j] . "',
                },";
            }
            $r = $r . "],
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
        }); </script>";
        } else if ($type == 'long') {

            if ($id == 'all') {
                $filter = "SELECT q.question_Id, `question`, `question_Type`,`answer` FROM `question`as q,`feedback_receiveables` as fr,`feedback` as f 
                WHERE question_Type='long' and f.feedback_id=fr.feedback_R_Id and q.question_Id=f.question_Id";
            } else {
                $filter = "SELECT q.question_Id, `question`, `question_Type`,`answer` FROM `question`as q,`feedback_receiveables` as fr,`feedback` as f 
                WHERE question_Type='$type' and f.feedback_id=$id and q.question_Id=f.question_Id";
            }


            $result = $conn->query($filter);

            $r = '<table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Question Name</th>
                                <th scope="col">Answer</th>
                                <th scope="col">Sentiment</th>
                            </tr>
                        </thead><tbody>';

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $sentiment = '';
                    //Find the largest value of the sentiment..
                    if (!is_null($row['answer'])) {
                        $answer = $row['answer'];
                        $senti_val = textToSentient($answer);
                        $neg = $senti_val['neg'] * 100;
                        $neu = $senti_val['neu'] * 100;
                        $pos = $senti_val['pos'] * 100;
                        if ($neg > $neu and $neg > $pos) {

                            $sentiment = $sentiment . '<span style="font-size:50px;">&#128524;</span>';
                        } else if ($neu > $neg and $neu > $pos) {
                            $sentiment = $sentiment . '<span style="font-size:50px;">&#128528;</span>';
                        } else {
                            $sentiment = $sentiment . '<span style="font-size:50px;">&#128522;</span>';
                        }
                    }
                    $r = $r . '<tr>
                        <td>' . $row['question_Id'] . '</td>
                        <td>' . $row['question'] . '</td>
                        <td>' . $row['answer'] . '</td>
                        <td>' . $sentiment . '</td>
                        <td>
                    </tr>';
                }
            }
            $r = $r . '</tbody></table>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Analyse|Admin Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Raleway&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="./plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="./plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="./plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="./plugins/daterangepicker/daterangepicker.css">

    <!-- Datatable plugin CSS file -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />

    <!-- Custome css !-->
    <link rel="stylesheet" href="../assets/css/teacher_dash.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include './main-nav.php' ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include './main-sidebar.php' ?>
        <!-- Main SideBar End -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Selected Students-->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-12">
                            <h1>Analyse Feedback</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="container-fluid filter_cont mt-3 mb-3">
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <div class="filter_field">
                                    <label>Feedback Id: </label>
                                    <select style="height:2.5rem;width:100%;" class="form-select form-select-lg mb-3"
                                        aria-label=".form-select-lg example" name="id">
                                        <option selected value="all">All</option>
                                        <?php

                                        $id = "SELECT `feedback_R_Id`, `status` FROM `feedback_receiveables` WHERE 1";
                                        $result = $conn->query($id);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option  value='" . $row['feedback_R_Id'] . "'>" . $row['feedback_R_Id'] . "</option>";
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="filter_field">
                                    <label>Feedback Type: </label>
                                    <select style="height:2.5rem;width:100%;" class="form-select form-select-lg mb-3"
                                        aria-label=".form-select-lg example" name="feedback_Type">
                                        <option selected value="rating">Rating</option>
                                        <option value="long">Long</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2 d-flex align-items-center" style="margin-top: 1rem;">
                                <div>
                                    <button class="btn btn-success">Search</button>
                                </div>
                            </div>
                        </div>
                </form>
                <div> <?php echo $r; ?></div>
        </div><!-- /.container-fluid -->
        </section>

        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Footer -->
    <?php include './footer.php' ?>
    </div>
    <!-- ./wrapper -->


    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
    // Dismiss the alert after 4 Sec
    setTimeout(
        function() {
            $(".alert").alert('close')
        }, 2000)


    $(function() {
        bsCustomFileInput.init();
    });
    </script>

    <!-- Page specific script -->
    <script>
    /* Initialization of datatable */
    $(document).ready(function() {
        $('#tableID').DataTable({});
    });
    </script>
    <script>
    $("button").on("click", function() {
        var id = $(this).data('id');
        var question = $(this).data('question');
        var question_Type = $(this).data('qt');
        var alumni = $(this).data('alumni');
        var employer = $(this).data('employer');
        var student = $(this).data('student');
        var parent = $(this).data('parent');
        var teacher = $(this).data('teacher');
        console.log(alumni, employer, student, parent, teacher);
        $('#question_Id').val(id);
        $('#question').val(question);
        $('#question_Type').val(question_Type);
    });
    </script>
</body>

</html>