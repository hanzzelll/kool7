<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kool7_car_aircon_specialist";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products from the aircon_parts table, sorted alphabetically by name
$sql = "SELECT * FROM aircon_parts ORDER BY name ASC";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="stylesheet" href="order_unlog.style.css">
</head>
<body>
    <div class="container">
        <h1>Order Products</h1>

        <div class="main" style="display: flex; justify-content: center; flex-direction: column; align-items: center;">
            <!-- Search bar and sorting options -->
            <div class="searchbar" style="text-align: center; margin-top: 50px;">
                <input type="text" id="searchInput" placeholder="Search..." style="margin-right: 10px;" onkeyup="searchTable()">
                <select id="sortOptions" onchange="sortTable()">
                    <option value="">Sort in...</option>
                    <option value="asc">Ascending order (A-Z)</option>
                    <option value="desc">Descending order (Z-A)</option>
                </select>
            </div>
        </div>

        <!-- Add margin to create space below the search bar -->
        <div style="margin-top: 30px;"></div>

        <!-- Product Grid -->
        <div class="product-grid" id="productGrid">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="product-card" data-name="<?php echo strtolower($row['name']); ?>" data-price="<?php echo $row['price']; ?>">
                        <img src="<?= htmlspecialchars($row['image']); ?>" alt="<?php echo $row['name']; ?>" style="width: 200px;">
                        <h3><?php echo $row['name']; ?></h3>
                        <p class="price">₱<?php echo number_format($row['price']); ?></p>
                        <form method="POST" action="order_unlog.php" onsubmit="return checkLoginStatus();">
                            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" value="1" min="1" max="10" <?php echo $row['quantity'] <= 0 ? 'disabled' : ''; ?>>
                            <button type="submit" name="add_to_cart" class="add-to-cart-btn" 
                                style="<?php echo $row['quantity'] <= 0 ? 'background-color: red; cursor: not-allowed;' : ''; ?>"
                                <?php echo $row['quantity'] <= 0 ? 'disabled' : ''; ?>>
                                <?php echo $row['quantity'] > 0 ? 'Add to Cart' : 'Out of Stock'; ?>
                            </button>
                        </form>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No products available</p>
            <?php endif; ?>
        </div>

        <div class="cart-summary">
            <p><strong>Items in Cart: <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></strong></p>
            <a href="cart.php" class="checkout-btn" onclick="return checkLoginStatus();">Go to Cart</a>
        </div>
    </div>

    <script>
        // Check if the user is logged in
        function checkLoginStatus() {
            <?php if (!isset($_SESSION['user_id'])): ?>
                var userResponse = confirm('You need an account to purchase items. Do you want to log in or create an account?');
                if (userResponse) {
                    window.location.href = 'userlogin.php'; // Redirect to login page
                } else {
                    window.location.href = 'order_unlog.php'; // Refresh the page
                }
                return false; // Prevent form submission or link navigation
            <?php endif; ?>
            return true; // Allow if logged in
        }

        // Search function for the product names
        function searchTable() {
            var input, filter, cards, card, name, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            cards = document.getElementById("productGrid").getElementsByClassName("product-card");
            
            for (i = 0; i < cards.length; i++) {
                card = cards[i];
                name = card.getElementsByTagName("h3")[0];
                txtValue = name.textContent || name.innerText;
                
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    card.style.display = "";
                } else {
                    card.style.display = "none";
                }
            }
        }

        // Sorting function for products
        function sortTable() {
            var grid, cards, switching, i, x, y, shouldSwitch, dir;
            grid = document.getElementById("productGrid");
            cards = grid.getElementsByClassName("product-card");
            switching = true;
            dir = document.getElementById("sortOptions").value; // Ascending or descending
            
            while (switching) {
                switching = false;
                for (i = 0; i < cards.length - 1; i++) {
                    shouldSwitch = false;
                    x = cards[i].getAttribute('data-name').toLowerCase();
                    y = cards[i + 1].getAttribute('data-name').toLowerCase();

                    if (dir === 'asc' && x > y) {
                        shouldSwitch = true;
                        break;
                    } else if (dir === 'desc' && x < y) {
                        shouldSwitch = true;
                        break;
                    }
                }

                if (shouldSwitch) {
                    cards[i].parentNode.insertBefore(cards[i + 1], cards[i]);
                    switching = true;
                }
            }
        }
    </script>
</body>
</html>
