<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Simulate payment success after user enters their GCash number
    $_SESSION['gcash_number'] = $_POST['gcash_number']; // Store the GCash number
    $_SESSION['payment_status'] = "Payment successful!";
    header("Location: confirmation.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gcash Payment</title>
    <script>
        function showLoading() {
            document.getElementById("loadingScreen").style.display = "block";
            setTimeout(function() {
                document.getElementById("loadingScreen").style.display = "none";
                alert('Payment Successful!');
                window.location.href = 'confirmation.php';
            }, 3000); // Simulate a 3-second loading
        }
    </script>
</head>
<body onload="showLoading()">
    <h1>Gcash Payment</h1>
    <form method="POST">
        <label for="gcash_number">Enter your GCash Number:</label>
        <input type="text" name="gcash_number" id="gcash_number" required>
        <button type="submit">Submit</button>
    </form>

    <div id="loadingScreen" style="display:none;">
        <p>Processing payment, please wait...</p>
    </div>
</body>
</html>
