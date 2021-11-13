<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program | HOD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- Datatable plugin CSS file -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />



</head>

<?php
$department_Id = 'cse';
include '../includes/conn.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $message = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"]) || (empty($_POST["program_Id"]))) {
            echo "error";
            die();
        } else {
            $name = $_POST["name"];
            $program_Id = $_POST["program_Id"];
            $update_Program = "UPDATE `program` SET `program_Name`='$name', WHERE `department_Id`='$department_Id' AND `program_Id`='$program_Id'";
            if ($conn->query($update_Program) === TRUE) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom:0;border-radius:0;">
                <strong>Program </strong> Successfully Updated !!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-bottom:0;border-radius:0;">
                <strong>Failed Try Again!!</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }
        }
    }
    $program = "SELECT `program_Id`, `program_Name` FROM `program` WHERE department_Id='$department_Id'";
    $result = $conn->query($program);
    $r = "";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $program_Id = $row["program_Id"];
            $program_Name = $row["program_Name"];
            $r = $r . '<tr>
                <td>' . $program_Id . '</td>
                <td>' . $program_Name . '</td>
                <td><button type="button" class="btn btn-primary" class="addAttr" data-toggle="modal" data-target="#addModal" 
                data-id="' . $program_Id . '" data-name="' . $program_Name . '"> Edit</button>
                <button type="button" class="delete btn btn-danger" value="' . $program_Id . '">Delete</button></td>
            </tr><br>';
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
                        <h1>Teacher</h1>
                    </div>
                </div>
                <?php echo $message; ?>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <table id="tableID" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                echo $r;
                                ?>
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <!-- jQuery library file -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js">
    </script>

    <!-- Datatable plugin JS library file -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js">
    </script>

    <script src=//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin=anonymous>
    </script>
    <script>
    /* Initialization of datatable */
    $(document).ready(function() {
        $('#tableID').DataTable({});
    });
    </script>
    <script>
    $("button").on("click", function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        $('#program_Id').val(id);
        $('#name').val(name);
    });
    $(".delete").on("click", function() {
        var clickBtnValue = $(this).val();
        var ajaxurl = 'delete-program.php',
            data = {
                'delete': clickBtnValue
            };
        $.post(ajaxurl, data, function(response) {
            // Response div goes here.
            console.log(response);
            if (response == 1) {
                alert("Delete successfully");
                location.reload();
            } else {
                alert("Delete failed");
            }

        });
    });
    </script>

    <!-- Modal -->
    <div id="addModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Teacher</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="program_Id">Program Id</label>
                                <input type="text" class="form-control" name="program_Id" id="program_Id" readonly
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="name">Program Name</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>