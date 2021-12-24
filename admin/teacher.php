<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- Datatable plugin CSS file -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />



</head>

<?php
include '../includes/conn.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    $message = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['teacher_Id']) || empty($_POST['name']) || empty($_POST['email']) || empty($_POST['department']) || empty($_POST['role'])) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-bottom:0;border-radius:0;">
                <strong>Empty Field Try Again </strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
        } else {
            // have to check if 2 hod exist in a dept or not

            $teacher_Id = $_POST['teacher_Id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $department_Id = $_POST['department'];
            $role = $_POST['role'];
            $sql = "UPDATE `teacher` SET `name`='$name',`email`='$email',`department_Id`='$department_Id', `role`='$role' WHERE `teacher_Id`='$teacher_Id'";
            if ($conn->query($sql) === TRUE) {

                $message = '<div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom:0;border-radius:0;">
                <strong> Updated Successfully !! </strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            } else {
                echo $conn->error;
            }
        }
    }

    $teacher = "SELECT `teacher_Id`, `name`, `email`, `department_Id`,`role` FROM `teacher` WHERE `verified`=1";
    $result = $conn->query($teacher);
    $r = "";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $teacher_Id = $row["teacher_Id"];
            $name = $row["name"];
            $email  = $row["email"];
            $department_Id = $row["department_Id"];
            $role = $row["role"];
            $dept = "SELECT `name` FROM `department` WHERE `department_Id`='$department_Id'";
            $dResult = $conn->query($dept);
            if ($dResult->num_rows > 0) {
                while ($row = $dResult->fetch_assoc()) {
                    $dept_Name = $row["name"];
                }
            }
            $r = $r . '<tr>
                <td>' . $teacher_Id . '</td>
                <td>' . $name . '</td>
                <td>' . $email . '</td>
                <td>' . $dept_Name . '</td>
                <td>' . $role . '</td>
                <td><button type="button" class="btn btn-primary" class="addAttr" data-toggle="modal" data-target="#addModal" 
                data-id="' . $teacher_Id . '" data-name="' . $name . '" data-email="' . $email . '"
                 data-department_Id="' . $department_Id . '" data-department_Name="' . $dept_Name . '" data-role="' . $role . '"> Edit</button></td>
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
                                    <th>Email</th>
                                    <th>Departemnt</th>
                                    <th>Role</th>
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
        var email = $(this).data('email');
        var department_Id = $(this).data('department_id');
        var role = $(this).data('role');
        $('#teacher_Id').val(id);
        $('#name').val(name);
        $('#email').val(email);
        $('#department').val(department_Id);
        $('#role').val(role);
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
                                <label for="teacher_Id">Teacher Id</label>
                                <input type="text" class="form-control" name="teacher_Id" id="teacher_Id" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="department">Department</label>
                                <select class="form-control select2 select2-danger"
                                    data-dropdown-css-class="select2-danger" style="width: 100%;" name="department"
                                    id="department" required>
                                    <?php
                                    include '../includes/conn.php';
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    } else {
                                        $sql = "SELECT `department_Id`, `name` FROM `department`";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<option value="' . $row["department_Id"] . '">' . $row["name"] . '</option>';
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control select2 select2-danger"
                                    data-dropdown-css-class="select2-danger" style="width: 100%;" id="role" name="role"
                                    required>
                                    <option value="teacher">Teacher</option>
                                    <option value="hod">HOD</option>
                                </select>
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