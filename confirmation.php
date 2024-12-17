<?php
session_start();

// Check if session data exists
if (!isset($_SESSION['payment_method']) || !isset($_SESSION['cart'])) {
    echo "Missing session data!";
    exit();
}

$payment_method = $_SESSION['payment_method'];
$payment_status = $_SESSION['payment_status'] ?? "No payment status available.";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <link rel="stylesheet" href="confirmation.style.css"> <!-- Link to external CSS -->
</head>
<body>
    <div class="container">
        <h1>Payment Confirmation</h1>
        <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($payment_method); ?></p>
        <p>Your order has been successfully reserved. To view your receipt and be able to print it, click the "View Receipt" button.</p>

        <a href="viewreceipt.php" class="view-receipt-btn">View Receipt</a>
    </div>
</body>
</html>
