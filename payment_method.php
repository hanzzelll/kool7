<?php
session_start();

// Simulate the order information (you would set these when the user orders a part)
$order_id = $_SESSION['order_id'] ?? null; // Ensure order_id is set after placing an order
$quantity_ordered = $_SESSION['quantity_ordered'] ?? null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_method = $_POST['payment_method'] ?? '';
    $gcash_number = $_POST['gcash_number'] ?? '';
    $amount = $_POST['amount'] ?? '';

    // Validate the amount
    if (empty($amount) || !is_numeric($amount) || $amount <= 0) {
        $error = "Please enter a valid amount.";
    } else {
        if ($payment_method === "gcash") {
            // Validate Gcash details
            if (!empty($gcash_number)) {
                $_SESSION['payment_status'] = "Payment of PHP $amount with Gcash processed successfully!";
                $_SESSION['payment_method'] = "gcash"; // Store payment method
                $_SESSION['payment_successful'] = true;
                header("Location: confirmation.php");
                exit();
            } else {
                $error = "Please enter your Gcash number.";
            }
        } elseif ($payment_method === "cash") {
            $_SESSION['payment_status'] = "Payment of PHP $amount with Cash will be collected.";
            $_SESSION['payment_method'] = "cash"; // Store payment method
            $_SESSION['payment_successful'] = true;
            header("Location: confirmation.php");
            exit();
        } else {
            $error = "Please select a valid payment method.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Method</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f9f9f9; }
        .container { max-width: 500px; margin: 50px auto; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 5px; }
        button { width: 100%; padding: 10px; background: #007bff; color: #fff; border: none; border-radius: 5px; font-size: 16px; }
        button:hover { background: #0056b3; cursor: pointer; }
        .error { color: red; margin-bottom: 15px; }
        #loading { display: none; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Payment Method</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form id="paymentForm" method="POST" action="">
            <div class="form-group">
                <label for="payment_method">Select Payment Method</label>
                <select name="payment_method" id="payment_method" required>
                    <option value="">-- Choose Payment Method --</option>
                    <option value="gcash">Gcash</option>
                    <option value="cash">Cash</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="text" name="amount" id="amount" placeholder="Enter amount" required>
            </div>

            <div id="gcash_field" style="display: none;">
                <div class="form-group">
                    <label for="gcash_number">Gcash Number</label>
                    <input type="text" name="gcash_number" id="gcash_number" placeholder="Enter your Gcash number">
                </div>
            </div>
            
            <button type="submit" onclick="return confirmSubmission()">Submit Payment</button>
        </form>
    </div>

    <!-- Loading Screen -->
    <div id="loading">
        <h2>Processing your payment...</h2>
        <img src="https://cdn.pixabay.com/animation/2023/10/08/03/19/03-19-26-213_512.gif" alt="Loading" width="100">
    </div>

    <script>
        // Toggle Gcash number field visibility
        document.getElementById('payment_method').addEventListener('change', function() {
            const paymentMethod = this.value;
            const gcashField = document.getElementById('gcash_field');
            gcashField.style.display = paymentMethod === 'gcash' ? 'block' : 'none';
        });

        // Show confirmation dialog and loading screen
        function confirmSubmission() {
            const confirmation = confirm("Are you sure to proceed with payment?");
            if (confirmation) {
                // Show loading screen and hide form
                document.querySelector('.container').style.display = 'none';
                document.getElementById('loading').style.display = 'block';

                // Simulate a delay (e.g., 3 seconds) before redirecting
                setTimeout(function() {
                    document.getElementById('paymentForm').submit(); // Submit the form after delay
                }, 3000); // 3000ms = 3 seconds
            }
            return false; // Prevent form submission immediately
        }
    </script>
</body>
</html>
