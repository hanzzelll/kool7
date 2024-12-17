<?php
session_start();
include 'db.php';

// Simulating order processing (no actual payment required)
$paymentStatus = 'success';  // Simulate successful payment
$orderId = 12345;  // Example order ID
$userEmail = 'user@example.com';  // Replace with the actual user email from session or database
$userPhone = '+1234567890';  // Replace with actual user phone number from session or database

// Check if payment is successful
if ($paymentStatus === 'success') {
    // Generate and send receipts
    $receiptContent = generateReceipt($orderId);
    $smsContent = generateSMSReceipt($orderId);
    
    // Send email and SMS
    sendEmailReceipt($userEmail, $receiptContent);
    sendSMSReceipt($userPhone, $smsContent);
    
    // Redirect to the success page or back to shopping
    header("Location: success.php");
    exit();
}

// Generate Email Receipt (HTML content)
function generateReceipt($orderId) {
    global $conn;

    // Query to get the order details from the database (example)
    $orderQuery = "SELECT * FROM orders WHERE id = ?";
    $stmt = $conn->prepare($orderQuery);
    $stmt->bind_param("i", $orderId);
    $stmt->execute();
    $result = $stmt->get_result();
    $order = $result->fetch_assoc();

    $receipt = "<h1>Order Confirmation</h1>";
    $receipt .= "<p>Order ID: {$order['id']}</p>";
    $receipt .= "<p>Date: {$order['order_date']}</p>";
    $receipt .= "<p>Items:</p><ul>";

    // Get order items
    $itemsQuery = "SELECT * FROM order_items WHERE order_id = ?";
    $stmt = $conn->prepare($itemsQuery);
    $stmt->bind_param("i", $orderId);
    $stmt->execute();
    $itemsResult = $stmt->get_result();

    while ($item = $itemsResult->fetch_assoc()) {
        $receipt .= "<li>{$item['product_name']} - ₱{$item['price']} x {$item['quantity']}</li>";
    }

    $receipt .= "</ul><p>Total: ₱{$order['total']}</p>";
    return $receipt;
}

// Generate SMS Receipt (Simple Text Content)
function generateSMSReceipt($orderId) {
    global $conn;

    // Query to get order total
    $query = "SELECT total FROM orders WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $orderId);
    $stmt->execute();
    $stmt->bind_result($total);
    $stmt->fetch();

    return "Your payment for Order ID: $orderId was successful. Total: ₱$total. Thank you for shopping with us!";
}

// Send Email Receipt using mail()
function sendEmailReceipt($email, $content) {
    $to = $email;
    $subject = "Receipt for Your Purchase";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: no-reply@yourwebsite.com";  // Change to your own email

    mail($to, $subject, $content, $headers);
}

// Send SMS Receipt using Twilio (Make sure to use the correct credentials)
function sendSMSReceipt($phone, $message) {
    $sid = 'yourAC1bfaebf05abd36d98fef40ea6af82fd8';  // Twilio SID
    $token = '52148e919a9a2f9cbe98bd08c63e5ea9';  // Twilio Auth Token
    $twilioNumber = '+13204387899';  // Your Twilio phone number

    $url = "https://api.twilio.com/2010-04-01/Accounts/$sid/Messages.json";

    $data = [
        'From' => $twilioNumber,
        'To' => $phone,
        'Body' => $message,
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_USERPWD, "$sid:$token");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
}
?>
