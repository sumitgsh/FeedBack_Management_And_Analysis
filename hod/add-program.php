<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Program</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<?php
$department_Id = 'cse';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../includes/conn.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $program_Id = strtoupper($_POST["program_Id"]);
        $program_Name = ucwords(strtolower($_POST["program_Name"]));
        try {
            $sql = "INSERT INTO `program`(`program_Id`, `program_Name`, `department_Id`) VALUES ('$program_Id','$program_Name','$department_Id')";
            if ($conn->query($sql) === TRUE) {
                echo "Program Added";
            } else {
                echo "error";
            }
        } catch (Exception $e) {
            //throw $th;
            echo $e;
            echo "exp";
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
                        <h1>Add Program</h1>
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
                                    <label for="program_Id">Program Id</label><br>
                                    <input type="text" class="form-control" name="program_Id" maxlength="11" required>
                                </div>
                                <div class="form-group">
                                    <label for="program_Name">Program Name</label>
                                    <input type="text" class="form-control" name="program_Name" maxlength="50" required>
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