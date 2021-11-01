<?php

include './includes/conn.php';
include './send-mail.php';

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} else {
	session_start();
	if (isset($_POST['submit'])) {
		$roll_No = mysqli_escape_string($conn, $_POST['roll_No']);
		$name = mysqli_escape_string($conn, $_POST['name']);
		$email = mysqli_escape_string($conn, $_POST['email']);
		$password = mysqli_escape_string($conn, $_POST['password']);
		/*
			 [X] Email validation of @tezu.ernet.in
			 [ ] Hash Password when User Provides
		*/

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "<script>alert(Invalid Email !!')</script>";
			exit();
		}

		# Email ID match..
		if (preg_match("/@tezu.ernet.in/i", $email) != 1) {
			echo '<script type="text/javascript">';
			echo 'alert("Use University Email Id!!");';
			echo 'window.location.href = "login.php";';
			echo '</script>';
		} else {

			#password hash before storing to the database..
			$hashedPsd = password_hash($password, PASSWORD_DEFAULT);

			# generate unique token for user verification
			$token = bin2hex(random_bytes(50));


			$query = "INSERT INTO student(roll_No,name,email,password) VALUES('$roll_No','$name','$email','$hashedPsd')";
			$result = mysqli_query($conn, $query);
			if ($result) {
				$_SESSION['name'] = $name;
				$_SESSION['email'] = $email;
				$_SESSION['roll_No'] = $roll_No;
				$_SESSION['success'] = "You are now logged in";

				# send verification email	
				sendVerificationEmail($email, $token);

				echo '<script type="text/javascript">';
				echo 'alert("Regiatration Successcull \n Please Verify Your Email to Login !!");';
				echo 'window.location.href = "login.php";';
				echo '</script>';
			}
		}
	}
}
