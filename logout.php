<?php
// Start the session
session_start();
// Unset the username cookie
setcookie("username", "", time() - 3600, "/"); // Set expiration in the past to delete the cookie

// Redirect to login page
header("Location: login.php");
exit();
?>
