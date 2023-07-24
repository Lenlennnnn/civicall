<?php
session_start();

// Function to sanitize input
function sanitize($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Database configuration
$host = 'localhost';
$dbUsername = 'root';
$dbPassword = 'leonard1011';
$dbName = 'civi_call';

// Connect to the database
$mysqli = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($mysqli->connect_error) {
    die('Database connection error: ' . $mysqli->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve form data
    $username = sanitize($_POST['username']);
    $password = sanitize($_POST['password']);

    // Prepare a select statement
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

    // Execute the query
    $result = $mysqli->query($query);

    if ($result->num_rows == 1) {
        // Valid credentials, set session variables and redirect
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid credentials
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>CiviCall Admin - Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/civicicon.png" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <!--===============================================================================================-->
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-form-title" style="background-image: url(images/homepage.jpg)">
                    <span class="login100-form-title-1">Admin's Portal</span>
                </div>

                <form class="login100-form validate-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="wrap-input100 validate-input m-b-26">
                        <span class="label-input100">Username</span>
                        <input class="input100" type="text" name="username" placeholder="Enter username">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-18">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password" placeholder="Enter password">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="flex-sb-m w-full p-b-30">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                            <label class="label-checkbox100" for="ckb1">Remember Me</label>
                        </div>

                        <div>
                            <a href="#" class="txt1">Forgot Password?</a>
                        </div>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="submit">Login</button>
                    </div>

                    <?php if (isset($error)) : ?>
                        <div class="error"><?php echo $error; ?></div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>
</body>

</html>