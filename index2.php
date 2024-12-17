<?php
// for contact_info table
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "kool7_car_aircon_specialist";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select data from your table
$sql = "SELECT id, phone, address, email FROM contact_info";

// Execute the query
$result = $conn->query($sql);

// Close the connection
    $conn->close();
?>
