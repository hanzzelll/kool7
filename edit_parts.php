<?php
// Database connection
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "root";        // Your database username
$password = "";            // Your database password
$dbname = "kool7_car_aircon_specialist"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission to update the part
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    // Update the part in the database
    $sql = "UPDATE aircon_parts SET name=?, quantity=?, price=?, image=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siisi", $name, $quantity, $price, $image, $id);

    if ($stmt->execute()) {
        echo "Part updated successfully!";
        header("Location: manage_parts.php"); // Redirect after successful update
        exit; // Ensure no further code is executed after redirect
    } else {
        echo "Error updating part: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch the part data for editing
$part_id = isset($_GET['id']) ? $_GET['id'] : 0;
$sql = "SELECT * FROM aircon_parts WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $part_id);
$stmt->execute();
$result = $stmt->get_result();
$part = $result->fetch_assoc();
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Aircon Part</title>
    <link rel="stylesheet" href="order_aircon_parts_styles.css">
</head>
<body>
    <h1>Edit Aircon Part</h1>
    
    <?php if ($part): ?>
        <form method="POST" action="edit_parts.php" id="editForm" onsubmit="return confirmEdit()">
            <input type="hidden" name="id" value="<?= $part['id']; ?>">

            <label for="name">Part Name:</label>
            <input type="text" name="name" id="name" value="<?= htmlspecialchars($part['name']); ?>" required>

            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" value="<?= $part['quantity']; ?>" required>

            <label for="price">Price (PHP):</label>
            <input type="number" name="price" id="price" value="<?= $part['price']; ?>" step="0.01" required>

            <label for="image">Image URL or Path:</label>
            <input type="text" name="image" id="image" value="<?= htmlspecialchars($part['image']); ?>" required>

            <button type="submit">Update Part</button>
        </form>

        <script>
            // Function to display confirmation popup before submitting the form
            function confirmEdit() {
                const confirmation = confirm("Are you sure you want to update this part?");
                if (confirmation) {
                    return true; // Continue submitting the form if confirmed
                } else {
                    return false; // Stop form submission if canceled
                }
            }
        </script>
    <?php else: ?>
        <p>Part not found.</p>
    <?php endif; ?>

</body>
</html>
