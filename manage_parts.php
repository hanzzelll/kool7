<?php
session_start();

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

// Handle deletion of a part
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM aircon_parts WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        echo "Part deleted successfully!";
    } else {
        echo "Error deleting part: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch all parts from the database
$sql = "SELECT * FROM aircon_parts";
$result = $conn->query($sql);

if ($result === FALSE) {
    die("Error executing query: " . $conn->error);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Aircon Parts</title>
    <link rel="stylesheet" href="manage_parts.css">
</head>
<body>
    <h1>Manage Aircon Parts</h1>

    <!-- Add Part Button on Top Right -->
    <div style="text-align: right; margin-bottom: 20px;">
        <a href="add_part.php" class="btn">Add New Part</a>
    </div>

    <?php if ($result->num_rows > 0): ?>
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>Part Name</th>
                    <th>Quantity</th>
                    <th>Price (PHP)</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['name']); ?></td>
                        <td>
                            <?php 
                                // Display "Out of Stock" if the quantity is 0
                                if ($row['quantity'] == 0) {
                                    echo "Out of Stock";
                                } else {
                                    echo $row['quantity'];
                                }
                            ?>
                        </td>
                        <td>PHP <?= number_format($row['price'], 2); ?></td>
                        <td><img src="<?= htmlspecialchars($row['image']); ?>" alt="<?= htmlspecialchars($row['name']); ?>" style="width: 50px;"></td>
                        <td>
                            <!-- Edit Button -->
                            <a href="edit_parts.php?id=<?= $row['id']; ?>" class="action-btn edit-btn">Edit</a> |
                            <!-- Delete Button -->
                            <a href="manage_parts.php?delete_id=<?= $row['id']; ?>" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this part?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No parts found in the database.</p>
    <?php endif; ?>

    <!-- Return to Dashboard Button -->
    <div style="text-align: center; margin-top: 20px;">
        <a href="dashboard.php" class="btn">Return to Dashboard</a>
    </div>
</body>
</html>
