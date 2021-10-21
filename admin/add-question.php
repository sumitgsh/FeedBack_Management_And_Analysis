<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Question</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../includes/conn.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        if (empty($_POST["question"]) || (empty($_POST["alumni"]) && empty($_POST["employeer"]) && empty($_POST["parent"]) && empty($_POST["student"]) && empty($_POST["teacher"]))) {
            echo "error";
            die();
        } else {
            $question = $_POST["question"];
            $question_Type = $_POST["question_Type"];
            $alumni =  isset($_POST['alumni']) ? $_POST["alumni"] : "";
            $employeer = isset($_POST['emoloyeer']) ? $_POST["employeer"] : "";
            $parent = isset($_POST['parent']) ? $_POST["parent"] : "";
            $student = isset($_POST['student']) ? $_POST["student"] : "";
            $teacher = isset($_POST['teacher']) ? $_POST["teacher"] : "";

            $a = array($alumni, $employeer, $parent, $student, $teacher);
            try {
                $sql = "INSERT INTO `question`(`question`, `question_Type`) VALUES ('$question','$question_Type')";
                $conn->query($sql);
                $id = $conn->insert_id;;
                foreach ($a as $value) {
                    if (!empty($value)) {
                        $sql = "INSERT INTO `questioncategory`(`category_Id`, `question_Id`) VALUES ('$value','$id')";
                        $conn->query($sql);
                    }
                }
                echo "Qustion Added";
            } catch (Exception $e) {
                //throw $th;
                echo $e;
                echo "exp";
            }
        }
    }
}
?>

<body>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Question</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="question">Question</label><br>
                                    <textarea id="question" class="form-control" name="question" rows="4" cols="50"
                                        required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="question_Type">Question Type</label><br>
                                    <select name="question_Type" id="question_Type"
                                        class="form-control select2 select2-danger"
                                        data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <option value="rating">Rating</option>
                                        <option value="long_Answer">Long Answer</option>
                                    </select><br>
                                </div>
                                <div class="form-group">
                                    <label for="question_Category">Question Category</label><br>
                                    <input type="checkbox" name="alumni" value="alumni">
                                    <label for="alumni"> Alumni</label><br>
                                    <input type="checkbox" name="employeer" value="employeer">
                                    <label for="employeer"> Employeer</label><br>
                                    <input type="checkbox" name="parent" value="parent">
                                    <label for="parent"> Parent</label><br>
                                    <input type="checkbox" name="student" value="student">
                                    <label for="student"> Student</label><br>
                                    <input type="checkbox" name="teacher" value="teacher">
                                    <label for="teacher"> Teacher</label>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
</body>

</html>