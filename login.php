<?php
session_start();
include './includes/conn.php';

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

        //Check whether email exist in the database along with verified or not
        $query = "SELECT * FROM student WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                $row['verified'];
                //check whether email is verified
                if ($row['verified'] == false) {
                    echo '<script type="text/javascript">';
                    echo 'alert("Your Email is not Verified !! Please verify");';
                    echo 'window.location.href = "login.php";';
                    echo '</script>';
                    exit(0);
                }

                //Password verify after getting the email
                $hash = $row['password'];
                // Verify password based on the hash returned by the above query	
                if (password_verify($password, $hash)) {
                    $_SESSION['student_Id'] = $row['student_Id'];
                    $_SESSION['roll_No'] = $row['roll_No'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['program_Id'] = $row['program_Id'];
                    $_SESSION['parent_Phone_No'] = $row['parent_Phone_No'];
                    $_SESSION['parent_Name'] = $row['parent_Name'];
                    $_SESSION['semester'] = $row['semester'];
                    $_SESSION['relation'] = $row['relation'];
                    $_SESSION['success'] = "You are now logged in";

                    header('location:dashboard.php');
                } else {
                    //Password did not matched with the hashed One
                    echo '<script type="text/javascript">';
                    echo 'alert("Password did Not Matched!!");';
                    echo 'window.location.href = "login.php";';
                    echo '</script>';
                    //   header('location: login.php');
                }
            }
        } else {

            # Email Id did not matched..
            echo '<script type="text/javascript">';
            echo 'alert("Email Id Did Not Matched!!");';
            echo 'window.location.href = "login.php";';
            echo '</script>';
        }
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author">
    <title>Login Page</title>
    <link rel="stylesheet" href="./assets/css/login_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Raleway&display=swap" rel="stylesheet">
</head>

<body>
    <div id="container">
        <div class="login">
            <div class="content">
                <h1>Log In</h1>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <input type="email" placeholder="email" name="email">
                    <input type="password" placeholder="password" name="password">
                    <div>
                        <label class="remember" for="remember">
                            <input type="checkbox" id="remember" name="remember_me" value="1" /><span>Remember me</span>
                        </label>
                        <span class="forget"><a href="forgot_psd.php">Forgot password?</a></span>
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
                <h1>Hello, friend!</h1>
                <p>Enter your personal details and start journey with us</p>
                <button type="" id="register">Register <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 16 16 12 12 8" />
                        <line x1="8" y1="12" x2="16" y2="12" />
                    </svg></button>
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
                <button type="" id="login"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 8 8 12 12 16" />
                        <line x1="16" y1="12" x2="8" y2="12" />
                    </svg> Log In</button>
            </div>
        </div>
        <div class="register">
            <div class="content">
                <h1>Sign Up</h1>
                <form action="register.php" method="POST">
                    <input type="text" placeholder="Roll No" id="rollNo" name="roll_No" required>
                    <input type="text" placeholder="Name" name="name" required>
                    <input type="email" placeholder="email@tezu.ernet.in" id="email" name="email" required>
                    <input type="password" placeholder="Password" name="password" required>
                    <label class="remember" for="terms">
                        <input type="checkbox" id="terms" required /><span>I accept terms</span>
                    </label>
                    <span class="clearfix"></span>
                    <button type="submit" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/js/index.js"></script>
    <script src="./assets/js/login_style.js"></script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script type="text/javascript">
    $('#rollNo').change(function() {
        $.ajax({
            url: "checkRoll.php",
            data: {
                roll_No: $('#rollNo').val()
            },
            type: "GET",
            context: document.body,
            success: function(result) {
                if ($.trim(result) == "1") {
                    alert("Record for this roll No already exists");
                }
            }
        });
    });

    $('#email').change(function() {
        $.ajax({
            url: "checkEmail.php",
            data: {
                email: $('#email').val()
            },
            type: "GET",
            context: document.body,
            success: function(result) {
                if ($.trim(result) == "1") {
                    alert("Record for this email already exists");
                }
            }
        });
    });
    </script>




</body>

</html>