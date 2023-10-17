<?php
// Configuration
$host = "localhost";
$port = 3308;
$user = "root";
$password = "";
$db = "indenting";
$table = "users";

// Connect to MySQL
$link = mysqli_connect($host, $user, $password, $db);
if (!$link) {
    die("Could not connect: " . mysqli_connect_error());
}

// Check if login form is submitted
if (isset($_POST['login'])) {
    // Retrieve the entered username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate email format for username
    if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid username format. Please enter a valid email address.";
    } else {
        // Validate password requirements
        $uppercase = preg_match('/[A-Z]/', $password);
        $lowercase = preg_match('/[a-z]/', $password);
        $number = preg_match('/\d/', $password);
        $symbol = preg_match('/[^A-Za-z0-9]/', $password);

        if (!$uppercase || !$lowercase || !$number || !$symbol) {
            $error = "Invalid password. Password must contain at least one uppercase letter, one lowercase letter, one symbol, and one number.";
        } else {
            // Fetch user record from the database
            $query = "SELECT * FROM $table WHERE username = '$username'";
            $result = mysqli_query($link, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                // Verify the entered password against the stored password
                if ($password === $user['password']) {
                    // Redirect to the home page or any other desired page
                    header('Location: new_user.html');
                    exit();
                }
            }

            // Invalid credentials
            $error = "Invalid credentials. Please try again.";
        }
    }
}

// Close the database connection
mysqli_close($link);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div id="header">
        <div id="img_left">
            <img src="uoh_logo_white.png" alt="University of Hyderabad">
        </div>
        <div class="heading">
            <h1>School of Computer and Information Sciences</h1>
            <h2>Library Books / Journals Indenting System</h2>
        </div>
        
        <div id="img_right">
            <img src="uoh_ioe_white.png" alt="University of Hyderabad">
        </div>
    </div>
    <div id="login-section">
        <div id="section" class="btn-group1">
            <button onclick="window.location.href='login.php'">Admin Login</button>
            <button onclick="window.location.href='faculty.php'">Faculty Login</button>
        </div>
        <div id="navigation">
            <div class="container">
                <h2><b>Admin Login</b></h2>
                <br><br>
                <?php if (isset($error)) : ?>
                    <p class="error-message"><?php echo $error; ?></p>
                <?php endif; ?>
        
                <form method="POST" action="">
                    <label for="username">Username:</label>
                    <input type="text" name="username" placeholder="Enter your email as username" required>
        
                    <label for="password">Password:</label>
                    <div style="position: relative;">
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                        <span id="password-toggle" class="password-toggle" onclick="togglePasswordVisibility()">
                            <img src="eye-slash.svg" alt="Toggle Password Visibility">
                        </span>
                    </div>
                    <br><br>
        
                    <center><input type="submit" name="login" value="Admin Login"></center>
                </form>
            </div>
        </div>
    
    
        <script>
            function togglePasswordVisibility() {
                var passwordInput = document.getElementById("password");
                var passwordToggle = document.getElementById("password-toggle");
    
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    passwordToggle.innerHTML = '<img src="eye.svg" alt="Toggle Password Visibility">';
                } else {
                    passwordInput.type = "password";
                    passwordToggle.innerHTML = '<img src="eye-slash.svg" alt="Toggle Password Visibility">';
                }
            }
        </script>
</body>
</html>

