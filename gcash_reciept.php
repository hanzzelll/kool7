<?php
session_start();

// Check if the user has selected GCash as their payment method
if ($_SESSION['payment_method'] !== 'gcash') {
    // Redirect to checkout page if the user didn't pay via GCash
    header("Location: checkout.php");
    exit();
}

// Get session data
$order_number = $_SESSION['order_number'] ?? rand(1000, 9999); // Use the order number if set
$cart = $_SESSION['cart'] ?? [];
$gcash_number = $_SESSION['gcash_number'] ?? 'Not provided';

// Payment status message
$payment_status = $_SESSION['payment_status'] ?? 'Payment successful!';

// Clear session data for receipt
unset($_SESSION['cart']);
unset($_SESSION['gcash_number']);
unset($_SESSION['payment_method']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        #receiptContent {
            border: 1px solid #000;
            padding: 20px;
            width: 50%;
            margin: 20px auto;
        }
        button {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Payment Receipt</h1>
    <div id="receiptContent">
        <h2>Order Number: <?php echo $order_number; ?></h2>
        <p><strong>Payment Method:</strong> GCash</p>
        <p><strong>GCash Number:</strong> <?php echo $gcash_number; ?></p>
        
        <h3>Items Purchased:</h3>
        <ul>
            <?php foreach ($cart as $part_id => $quantity_ordered): ?>
                <li>Part ID: <?php echo $part_id; ?>, Quantity: <?php echo $quantity_ordered; ?></li>
            <?php endforeach; ?>
        </ul>

        <p><strong>Status:</strong> <?php echo $payment_status; ?></p>

        <button onclick="window.print()">Print Receipt</button>
    </div>

    <br>
    <a href="order_aircon_parts.php">Order More Parts</a> | <a href="userlogin.php">Go to Login</a>
</body>
</html>
