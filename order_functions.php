<?php
// order_functions.php - Contains functions related to order creation

function createOrder($user_id, $cart) {
    global $conn;

    if (!$conn) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the order into the orders table
    $orderQuery = "INSERT INTO orders (user_id, total) VALUES (?, ?)";
    $stmt = $conn->prepare($orderQuery);
    if ($stmt === false) {
        die('Error preparing query: ' . $conn->error);
    }
    $stmt->bind_param("id", $user_id, $cart['total']);
    $stmt->execute();
    $order_id = $stmt->insert_id;  // Get the last inserted ID (order ID)
    $stmt->close();

    // Insert each item in the cart into the order_items table
    foreach ($cart['items'] as $item) {
        $itemQuery = "INSERT INTO order_items (order_id, part_id, product_name, quantity, price) 
                      VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($itemQuery);
        $stmt->bind_param("iisis", $order_id, $item['part_id'], $item['product_name'], $item['quantity'], $item['price']);
        $stmt->execute();
        $stmt->close();
    }

    return $order_id;
}
?>
