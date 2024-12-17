<?php

// Start the session
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Provided usernames and passwords
$users = array(
    "kool7" => "mejaki1996",
    "kistis" => "meow"
);

$error_message = ""; // Initialize error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $username = isset($_POST["username"]) ? $_POST["username"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

    // Check if the provided username exists in the users array
    if (array_key_exists($username, $users)) {
        // Verify the password
        if ($password === $users[$username]) {
            // Password is correct, set cookie and redirect to dashboard
            setcookie("username", $username, time() + (86400 * 30), "/"); // 86400 = 1 day
            header("Location: dashboard.php");
            exit();
        } else {
            // Password is incorrect, set error message
            $error_message = "Incorrect username or password.";
        }
    } else {
        // Username not found, set error message
        $error_message = "Incorrect username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
    <!-- Include Font Awesome CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="login-box">
            <h1>Admin Login</h1>

            <div class="textbox">
                <i class="fa fa-user" aria-hidden="true"></i>
                <input type="text" placeholder="Username" name="username">
            </div>

            <div class="textbox">
                <i class="fa fa-lock" aria-hidden="true"></i>
                <input type="password" placeholder="Password" name="password">
            </div>

            <input type="submit" class="button" name="login" value="Sign In">

            <!-- Display error message if present -->
            <?php if (!empty($error_message)): ?>
                <p style="color: red;"><?php echo $error_message; ?></p>
            <?php endif; ?>
        </div>
    </form>
</body>
</html>