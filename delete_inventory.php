<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kool7_car_aircon_specialist";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get item ID from the URL parameter
if (isset($_GET['id'])) {
    $itemId = $_GET['id'];

    // SQL to delete item from inventory
    $sql = "DELETE FROM inventory WHERE tool_id = $itemId";

    if ($conn->query($sql) === TRUE) {
        // Record deleted successfully, redirect back to inventory.php
        header("Location: inventory.php");
        exit();
    } else {
        // Error deleting item
        echo "Error deleting item: " . $conn->error;
    }
} else {
    echo "Item ID not provided";
}

$conn->close();
?>