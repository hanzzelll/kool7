<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kool7_car_aircon_specialist";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if session data is set
if (!isset($_SESSION['payment_method']) || $_SESSION['payment_method'] !== 'cash') {
    echo "Invalid access. Please go back to the checkout page.";
    exit();
}

// Fetch reserved item and quantity from the session
if (!isset($_SESSION['reserved_item']) || !isset($_SESSION['reserved_quantity'])) {
    echo "No reservation found.";
    exit();
}

$item_name = $_SESSION['reserved_item'];
$reserved_quantity = (int)$_SESSION['reserved_quantity'];

// Generate a unique reservation number
$reservation_number = "R" . strtoupper(uniqid());

// Update the quantity in the database
$sql_update = "UPDATE aircon_parts SET quantity = quantity - ? WHERE name = ? AND quantity >= ?";
$stmt = $conn->prepare($sql_update);
$stmt->bind_param("isi", $reserved_quantity, $item_name, $reserved_quantity);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        $status = "Reservation successful!";
    } else {
        $status = "Failed to reserve the item. Not enough stock.";
    }
} else {
    $status = "Error updating the database: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cash Payment</title>
</head>
<body>
    <h1>Reservation Receipt</h1>
    
    <p><strong>Reservation Number:</strong> <?php echo htmlspecialchars($reservation_number); ?></p>
    <p><strong>Item Reserved:</strong> <?php echo htmlspecialchars($item_name); ?></p>
    <p><strong>Quantity Reserved:</strong> <?php echo htmlspecialchars($reserved_quantity); ?></p>
    <p><strong>Status:</strong> <?php echo htmlspecialchars($status); ?></p>

    <form method="POST" action="manage_parts.php">
        <button type="submit">Go to Manage Parts</button>
    </form>

    <form method="POST" action="dashboard.php">
        <button type="submit">Return to Dashboard</button>
    </form>
</body>
</html>
