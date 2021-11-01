<?php

include '../includes/conn.php';

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} else {
	if (isset($_POST['submit'])) {
		$email = mysqli_escape_string($conn, $_POST['email']);
		$password = mysqli_escape_string($conn, $_POST['password']);
		$message = "";
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
				if (password_verify($password, $hash)) {
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

</head>

<body>
    <div id="container">
        <div class="login">
            <div class="content">
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
                <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                    <circle cx="8.5" cy="7" r="4" />
                    <line x1="20" y1="8" x2="20" y2="14" />
                    <line x1="23" y1="11" x2="17" y2="11" />
                </svg>
                <h1>Hello!</h1>
                <p>Enter your personal details and start journey with us</p>
            </div>
        </div>
        <div class="page back">
            <div class="content">
                <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                    <polyline points="10 17 15 12 10 7" />
                    <line x1="15" y1="12" x2="3" y2="12" />
                </svg>
                <h1>Welcome Back!</h1>
                <p>To keep connected with us please login with your personal info</p>
                <button type="" id="login" name="submit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 8 8 12 12 16" />
                        <line x1="16" y1="12" x2="8" y2="12" />
                    </svg> Log In</button>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.2.0/aos.js"></script>
    <script src="assets/js/index.js"></script>
    <script src="./assets/js/login_style.js"></script>
</body>

</html>