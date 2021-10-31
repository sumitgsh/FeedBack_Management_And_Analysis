<?php
include '../includes/conn.php';

// Session check if logged In the open the page else redirect to login.
session_start();
if(isset($_SESSION['success']) && !empty($_SESSION['success'])) {
  header('location:index.php');
}

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} else {
  if (isset($_POST['submit'])) {

    $email = mysqli_escape_string($conn, $_POST['email']);
    $password = mysqli_escape_string($conn, $_POST['password']);

    //Remember me 
    if (isset($_POST["remember_me"])) {
      if ($_POST["remember_me"] == '1') {
        //For 30days it will be saved 
        $hour = time() + 3600 * 24 * 30;
        setcookie('email', $email, $hour);
        setcookie('password', $password, $hour);
      }
    }

    $query = "SELECT * FROM super_admin WHERE email = '$email' AND pass='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
      $_SESSION['email'] = $email;
      while ($row = $result->fetch_assoc()) {
        $_SESSION['name'] = $row['name'];
      }
      $_SESSION['success'] = "You are now logged in";
      header('location: index.php');
    } else {
      $message = '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-bottom:0;border-radius:0;">
                <strong> Email or Password Incorrect !! </strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
      echo $message;
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FeedBack Management|Admin Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="login.php"><b>Super Admin Login</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="login.php" method="post">
          <div class="input-group mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input value="1" type="checkbox" id="remember" name="remember_me">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>



        <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p>

      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>