<?php
$servername = "localhost";
$dbname = "kool7_car_aircon_specialist";
$username = "kool7"; // Replace with your database username
$password = "mejaki1996"; // Replace with your database password

try {
    $conn = new PDO(
        "mysql:host=$servername;dbname=$dbname",
        $username,
        $password
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit(); // Stop further execution if the connection fails
}
?>