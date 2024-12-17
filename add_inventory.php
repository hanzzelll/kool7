<?php
// Include database connection
include 'conn.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $category = $_POST['category'];
    $tool_name = $_POST['tool_name'];
    $available_size = $_POST['available_size'];
    $status = $_POST['status'];
    $quantity = $_POST['quantity'];

    // SQL query to insert data into inventory table
    $sql = "INSERT INTO inventory (category, tool_name, available_size, status, quantity) VALUES ('$category', '$tool_name', '$available_size', '$status', '$quantity')";

    // Execute query
    if (mysqli_query($conn, $sql)) {
        // Record added successfully, redirect to inventory page or show success message
        header("Location: inventory.php");
        exit();
    } else {
        // Error in adding record
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Inventory Item</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Add Inventory Item</h2>
            <form action="add_inventory.php" method="POST">
                <!-- Add input fields for adding a new inventory item -->
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" class="form-control" id="category" name="category" placeholder="Enter category">
                </div>
                <div class="mb-3">
                    <label for="tool_name" class="form-label">Tool Name</label>
                    <input type="text" class="form-control" id="tool_name" name="tool_name" placeholder="Enter tool name">
                </div>
                <div class="mb-3">
                    <label for="available_size" class="form-label">Available Size</label>
                    <input type="text" class="form-control" id="available_size" name="available_size" placeholder="Enter available size">
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <input type="text" class="form-control" id="status" name="status" placeholder="Enter status">
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter quantity">
                </div>
                <!-- Add other input fields as needed -->
                <button type="submit" class="btn btn-primary">Add Item</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>