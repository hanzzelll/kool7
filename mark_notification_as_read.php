<?php
session_start();
header('Content-Type: application/json');

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

// Get the ID of the notification from the request
$data = json_decode(file_get_contents("php://input"));
$notificationId = $data->id;
$email = $_SESSION['email'];  // Assuming user is logged in

// Update the notification status to 'read'
$query = "UPDATE notifications SET status='read' WHERE id='$notificationId' AND user_email='$email'";
if ($mysqli->query($query) === TRUE) {
    // Fetch the new unread count
    $unreadCountQuery = "SELECT COUNT(*) AS unread_count FROM notifications WHERE user_email='$email' AND status='unread'";
    $unreadCountResult = mysqli_query($mysqli, $unreadCountQuery);
    $unreadCountData = mysqli_fetch_assoc($unreadCountResult);
    $unreadCount = $unreadCountData['unread_count'];

    echo json_encode(['success' => true, 'unreadCount' => $unreadCount]);
} else {
    echo json_encode(['success' => false]);
}
?>