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

// Handle form submission to add a new part
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    // Insert new part into the database
    $sql = "INSERT INTO aircon_parts (name, quantity, price, image) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siis", $name, $quantity, $price, $image);

    if ($stmt->execute()) {
        echo "New part added successfully!";
    } else {
        echo "Error adding part: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Aircon Part</title>
    <link rel="stylesheet" href="manage_parts.css">
</head>
<body>
    <h1>Add New Aircon Part</h1>

    <form method="POST" action="add_part.php">
        <label for="name">Part Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" required>

        <label for="price">Price (PHP):</label>
        <input type="number" name="price" id="price" step="0.01" required>

        <label for="image">Image URL or Path:</label>
        <input type="text" name="image" id="image" required>

        <button type="submit">Add Part</button>
    </form>

    <div style="text-align: center; margin-top: 20px;">
        <a href="manage_parts.php" class="btn">Return to Manage Parts</a>
    </div>
</body>
</html>
