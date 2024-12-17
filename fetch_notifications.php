<?php
session_start();

$servername = "localhost"; // or your server name
$username = "root"; // database username
$password = ""; // database password
$database = "kool7_car_aircon_specialist"; // your database name

// Create connection
$mysqli = new mysqli($servername, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die(json_encode(['error' => 'Database connection failed: ' . $mysqli->connect_error]));
}

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

// Get the user's email from the session
$email = $_SESSION['email'];

// Fetch notifications for the logged-in user
$notificationsQuery = "SELECT * FROM notifications WHERE user_email='$email' ORDER BY created_at DESC LIMIT 10";
$notificationsResult = $mysqli->query($notificationsQuery);

$notifications = [];
if ($notificationsResult) {
    while ($notification = $notificationsResult->fetch_assoc()) {
        $notifications[] = $notification;
    }
}

// Fetch unread notification count
$unreadCountQuery = "SELECT COUNT(*) AS unread_count FROM notifications WHERE user_email='$email' AND status='unread'";
$unreadCountResult = $mysqli->query($unreadCountQuery);
$unreadCount = 0;
if ($unreadCountResult) {
    $unreadCountData = $unreadCountResult->fetch_assoc();
    $unreadCount = $unreadCountData['unread_count'];
}

// Return response as JSON
echo json_encode([
    'notifications' => $notifications,
    'unreadCount' => $unreadCount
]);
?>