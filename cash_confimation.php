<?php
session_start();

$order_number = $_SESSION['order_number'] ?? rand(1000, 9999); // Use a generated order number if not set
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation</title>
</head>
<body>
    <h1>Payment Successful!</h1>
    <p>Your item(s) have been reserved and are ready for pickup at Kool 7 Shop.</p>
    <p>Order Number: <?php echo $order_number; ?></p>

    <a href="order_aircon_parts.php">Order More Parts</a> | <a href="userlogin.php">Go to Login</a>
</body>
</html>
