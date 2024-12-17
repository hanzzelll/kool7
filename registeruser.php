<?php

require 'vendor/autoload.php';  // Path to autoload.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Database connection
$servername = "localhost"; // Update with your database server name
$username = "root"; // Update with your database username
$password = ""; // Update with your database password
$database = "kool7_car_aircon_specialist"; // Update with your database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = ""; // Initialize message
$redirect = ""; // Initialize redirect link

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    // Get form data
    $username = $conn->real_escape_string($_POST["username"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password
    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $address = $conn->real_escape_string($_POST["address"]);
    $phone_number = $conn->real_escape_string($_POST["phone_number"]);
    $age = (int)$_POST["age"];
    $gender = $conn->real_escape_string($_POST["gender"]);

    // Insert into database
    $sql = "INSERT INTO users (username, password, name, email, address, phone_number, age, gender) 
            VALUES ('$username', '$password', '$name', '$email', '$address', '$phone_number', $age, '$gender')";

    if ($conn->query($sql) === TRUE) {
        // Send confirmation email using PHPMailer
        $mail = new PHPMailer(true);
        try {
            // Server settings for Gmail SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Set the SMTP server to use (Gmail)
            $mail->SMTPAuth = true;
            $mail->Username = 'kool7.owner@gmail.com';  // Gmail address
            $mail->Password = 'brhh opcc qldi ojyy';  // Gmail password (use app-specific password if 2FA is enabled)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('kool7.owner@gmail.com', 'Kool 7 Car Aircon Specialist');
            $mail->addAddress($email, $name);  // User's email address

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Registration Confirmation';
            $mail->Body    = "
            Hello $name,<br><br>

            Your registration details are as follows:<br>
            Username: $username<br>
            Email Address: $email<br><br>

            Thank you for registering with us.<br><br>

            Best regards,<br>
            Kool7
            ";

            // Send the email
            $mail->send();

            // Show success message
            $message = "User Registered successfully.";
            $redirect = "userlogin.php";

        } catch (Exception $e) {
            // Handle email sending failure
            $message = "Registration successful, but email could not be sent. Please try again later.";
        }
    } else {
        $message = "Registration error. Please try again.";
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <script>
        // Function to show a popup message
        function showPopup(message, redirect) {
            alert(message); // Display the popup message
            if (redirect) {
                window.location.href = redirect; // Redirect if a link is provided
            }
        }
    </script>
</head>
<body>
    <?php if (!empty($message)): ?>
        <script>
            showPopup("<?php echo $message; ?>", "<?php echo $redirect; ?>");
        </script>
    <?php endif; ?>
</body>
</html>