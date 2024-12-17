<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "kool7_car_aircon_specialist";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("location: user_login.php");
    exit;
}

// Get the user's email from the session
$email = $_SESSION['email'];

// Fetch unread notifications count
$notificationQuery = "SELECT COUNT(*) as unread_count FROM notifications WHERE user_email='$email' AND status='unread'";
$notificationResult = $mysqli->query($notificationQuery);

if (!$notificationResult) {
    die("Query failed: " . $mysqli->error);
}

$notificationData = $notificationResult->fetch_assoc();
$unreadCount = $notificationData['unread_count'] ?? 0; // Default to 0 if no result
?>