<?php
session_start();

// If cart is empty, redirect to order page
if (empty($_SESSION['cart'])) {
    header("Location: order_aircon_parts.php");
    exit();
}

// Update cart quantity
if (isset($_POST['update_cart'])) {
    foreach ($_POST['quantity'] as $product_id => $quantity) {
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] = $quantity;
        }
    }
    header("Location: cart.php");
    exit();
}

// Calculate total price
$total_price = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_price += $item['price'] * $item['quantity'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="cart.style.css">
</head>
<body>
    <div class="container">
        <h1>Your Cart</h1>
        <form method="POST" action="cart.php">
            <div class="cart-items">
                <?php foreach ($_SESSION['cart'] as $product_id => $item): ?>
                    <div class="cart-item">
                        <p><?php echo $item['name']; ?></p>
                        <p>₱<?php echo number_format($item['price']); ?></p>
                        <input type="number" name="quantity[<?php echo $product_id; ?>]" value="<?php echo $item['quantity']; ?>" min="1" max="10">
                        <p>Total: ₱<?php echo number_format($item['price'] * $item['quantity']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="submit" name="update_cart" class="update-cart-btn">Update Cart</button>
        </form>
        <div class="cart-summary">
            <p><strong>Total Price: ₱<?php echo number_format($total_price); ?></strong></p>
            <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
        </div>
    </div>
</body>
</html>
