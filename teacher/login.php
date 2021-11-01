<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author">
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
	<div id="container">
		<div class="login">
			<div class="content">
				<h1>Log In</h1>
				<form>
					<input type="email" placeholder="email">
					<input type="password" placeholder="password">
					<div>
						<label class="remember" for="remember">
							<input type="checkbox" id="remember" checked /><span>Remember me</span>
						</label>
						<span class="forget"><a href="#">Forgot password?</a></span>
						<span class="clearfix"></span>
					</div>
					<button onclick="return false;">Log In</button>
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
				<h1>Hello, friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button type="" id="register">Register <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<circle cx="12" cy="12" r="10" />
						<polyline points="12 16 16 12 12 8" />
						<line x1="8" y1="12" x2="16" y2="12" />
					</svg></button>
			</div>
		</div>
		<div class="page back">
			<div class="content">
				<svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
					<polyline points="10 17 15 12 10 7" />
					<line x1="15" y1="12" x2="3" y2="12" />
				</svg>
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button type="" id="login"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<circle cx="12" cy="12" r="10" />
						<polyline points="12 8 8 12 12 16" />
						<line x1="16" y1="12" x2="8" y2="12" />
					</svg> Log In</button>
			</div>
		</div>
		<div class="register">
			<div class="content">
				<h1>Sign Up</h1>
				<form>
					<input type="text" placeholder="name">
					<input type="email" placeholder="email">
					<input type="password" placeholder="password">
					<label class="remember" for="terms">
						<input type="checkbox" id="terms" /><span>I accept terms</span>
					</label>
					<span class="clearfix"></span>
					<button onclick="return false;">Submit</button>
				</form>
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