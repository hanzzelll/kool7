<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_method = $_POST['payment_method'] ?? '';
    $_SESSION['payment_method'] = $payment_method;

    if ($payment_method === 'gcash') {
        // Store the GCash number temporarily and show the confirmation page
        $gcash_number = $_POST['gcash_number'] ?? '';
        $_SESSION['gcash_number'] = $gcash_number;
        $_SESSION['payment_status'] = "Your order has been reserved. Please proceed with GCash payment.";
        header("Location: confirmation.php"); // Redirect to confirmation.php
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="checkout.style.css"> <!-- Link to external CSS -->
</head>
<body>
    <div class="container">
        <h1 class="title">Checkout</h1>
        <form method="POST" class="checkout-form">
            <label for="gcash_number" class="label">Enter your GCash Number:</label>
            <input type="text" name="gcash_number" id="gcash_number" class="input" required>

            <input type="hidden" name="payment_method" value="gcash"> <!-- Hidden field for payment method -->

            <button type="submit" class="submit-btn">Proceed to Payment</button>
        </form>
    </div>
</body>
</html>
