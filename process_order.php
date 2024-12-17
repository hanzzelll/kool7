<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection
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

// Get the part details and quantity ordered
$part_id = $_POST['part_id'];
$quantity_ordered = $_POST['quantity'];

// Fetch the current quantity of the part
$sql = "SELECT quantity FROM aircon_parts WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $part_id);
$stmt->execute();
$result = $stmt->get_result();
$part = $result->fetch_assoc();
$stmt->close();

// Check if enough stock is available
if ($part['quantity'] >= $quantity_ordered) {
    // Reduce the quantity in the database
    $new_quantity = $part['quantity'] - $quantity_ordered;
    $sql_update = "UPDATE aircon_parts SET quantity=? WHERE id=?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ii", $new_quantity, $part_id);
    
    if ($stmt_update->execute()) {
        // Redirect to the payment confirmation page after successful order
        header("Location: method_payment.php?order_id=" . $part_id . "&quantity=" . $quantity_ordered);
        exit();
    } else {
        echo "Error updating part quantity: " . $stmt_update->error;
    }
    
    $stmt_update->close();
} else {
    echo "Not enough stock available to fulfill your order.";
}

$conn->close();
?>
