<?php
// Include database connection
include 'conn.php';

// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_COOKIE['username'])) {
    header("Location: login.php");
    exit();
}

// Determine the logged-in user
$username = $_SESSION['username'] ?? $_COOKIE['username'] ?? null;
if (!$username) {
    header("Location: login.php");
    exit();
}

// Path to the certificate file (e.g., in the 'uploads/certificates/' folder)
$certificate_path = "certificate.jpg"; // Change this to your actual certificate file path

// Check if the certificate exists
if (!file_exists($certificate_path)) {
    $message = "No certificate found. Please upload a certificate first.";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Certificate</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        /* Container to hold the certificate */
        .certificate-view {
            margin-top: 20px;
            text-align: center;
        }

        /* Styles for the certificate display to simulate A4 size */
        .certificate-view iframe,
        .certificate-view img {
            width: 21cm; /* A4 width */
            height: 29.7cm; /* A4 height */
            object-fit: contain;
            border: 1px solid #ddd; /* Optional border */
            margin-bottom: 20px; /* Add margin for space below certificate */
        }

        /* Center the print button */
        .print-button-container {
            text-align: center;
            margin-top: 20px;
        }

        .print-button {
            padding: 5px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .print-button:hover {
            background-color: #0056b3;
        }

        /* Return to dashboard button */
        .return-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #a10808;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            .certificate-view, .certificate-view * {
                visibility: visible;
            }

            .certificate-view {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                page-break-before: always;
                margin: 0;
                padding: 0;
                transform: scale(0.8); /* Scales the certificate to fit the page */
                transform-origin: top left;
            }

            .print-button {
                display: none;
            }

            .return-btn {
                display: none;
            }
        }
    </style>
    <script>
        function printCertificate() {
            window.print();
        }
    </script>
</head>

<body>
    <div class="logosec">
        <div class="logo">KOOL 7 CAR AIRCON SPECIALIST</div>
    </div>

    <div class="certificate-view">

        <?php if (isset($message)): ?>
            <p><?php echo $message; ?></p>
        <?php elseif (file_exists($certificate_path)): ?>
            <?php
            $file_extension = strtolower(pathinfo($certificate_path, PATHINFO_EXTENSION));
            if ($file_extension == 'pdf') {
                echo '<iframe src="' . $certificate_path . '" frameborder="0"></iframe>';
            } else {
                echo '<img src="' . $certificate_path . '" alt="Certificate">';
            }
            ?>
            <!-- Center the print button -->
            <div class="print-button-container">
                <button class="print-button" onclick="printCertificate()">Print Certificate</button>
            </div>
        <?php endif; ?>
    </div>

    <!-- Return to Dashboard Button -->
    <div style="text-align: center; margin-top: 20px;">
        <a href="dashboard.php" class="return-btn">Return to Dashboard</a>
    </div>
</body>

</html>
