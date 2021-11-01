<?php

include '../includes/conn.php';

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} else {
	if (isset($_POST['submit'])) {
		$email = mysqli_escape_string($conn, $_POST['email']);
		$password = mysqli_escape_string($conn, $_POST['password']);
		$message="";
		//Remember me 
		if (isset($_POST["remember_me"])) {
			if ($_POST["remember_me"] == '1') {
				//For 30days it will be saved 
				$hour = time() + 3600 * 24 * 30;
				setcookie('email', $email, $hour);
				setcookie('password', $password, $hour);
			}
		}

		$query = "SELECT * FROM teacher WHERE email = '$email'";
		$result = mysqli_query($conn, $query);

		if (mysqli_num_rows($result) == 1) {
			while ($row = $result->fetch_assoc()) {

				//Password verify after getting the email
				$hash = $row['password'];
				// Verify password based on the hash returned by the above query	
				// if (password_verify($password, $hash)) {
				if ($hash == $password) {
					$_SESSION['teacher_Id'] = $row['teacher_Id'];
					$_SESSION['name'] = $row['name'];
					$_SESSION['email'] = $row['email'];
					$_SESSION['departent_Id'] = $row['department_Id'];
					$_SESSION['role'] = $row['role'];
					$_SESSION['success'] = "You are now logged in";
					
					header('location:index.php');
				} else {
					//Password did not matched with the hashed One
					$message = '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="width:100%";>
					<strong> Password did Not matched !! </strong>
					<button type="button" class="close" style="position:absolute;top: -22px;;width:0;"  data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>';
					//   header('location: login.php');
				}
			}
		} else {
			$message = '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="width:100%";>
					<strong>Email Id did Not Matched !! </strong>
					<button type="button" class="close" style="position:absolute;top: -22px;;width:0;"  data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>';
		}
	}
}


?>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Yinka Enoch Adedokun">
	<title>Login Page</title>
	<link rel="stylesheet" href="../assets/css/admin_login_style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="../assets/css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.2.0/aos.css">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Raleway&display=swap" rel="stylesheet">
</head>

<body>

	<!-- <nav class="navbar navbar-light navbar-expand-md navigation-clean-button" style="position:fixed; width:100%;z-index:1;">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">Online Feedback System</a>
			<button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1">
				<span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon">
				</span></button>
			<div class="collapse navbar-collapse" id="navcol-1">
				<ul class="nav navbar-nav mr-auto">
					<li class="nav-item"><a class="nav-link active" href="#">First Item</a></li>
					<li class="nav-item"><a class="nav-link" href="#">Second Item</a></li>
					</li>
				</ul>
				<span class="navbar-text actions">
					<a class="login" href="">Log In</a>
				</span>
				<span>
					<div class="dropdown show">
						<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Register As
						</a>

						<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
							<a class="dropdown-item" href="./login.php">Student</a>
							<a class="dropdown-item" href="#">Employers</a>
						</div>
					</div>
				</span>
			</div>
		</div>
	</nav> -->
	<div id="container">
		<div class="login">
			<div class="content">
				<!-- Password did not matched show the alert  -->
				<?php
				 if(isset($_POST['submit']) && strlen($message)>1)
				 {
					 echo $message;
				 }
				?>
				<h1>Log In</h1>

				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
					<input type="email" name="email" placeholder="email">
					<input type="password" name="password" placeholder="password">
					<div>
						<label class="remember" for="remember">
							<input type="checkbox" id="remember" checked /><span>Remember me</span>
						</label>
						<span class="forget"><a href="#">Forgot password?</a></span>
						<span class="clearfix"></span>
					</div>
					<button type="submit" name="submit">Log In</button>
				</form>


			</div>
		</div>
		<div class="page front">
			<div class="content">
				<svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
					<circle cx="8.5" cy="7" r="4" />
					<line x1="20" y1="8" x2="20" y2="14" />
					<line x1="23" y1="11" x2="17" y2="11" />
				</svg>
				<h1>Hello, HOD!</h1>
				<p>Enter your personal details and start journey with us</p>

			</div>
		</div>


	</div>
	<script>
		// Dismiss the alert after 4 Sec
		setTimeout(
		  function() {
		    $(".alert").alert('close')
		  }, 4000)
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.2.0/aos.js"></script>
	<script src="assets/js/index.js"></script>
	<script src="./assets/js/login_style.js"></script>
</body>

</html>