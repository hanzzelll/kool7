<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to your MySQL database (replace placeholders with your actual database credentials)
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

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO Feedback (name, email, phone, satisfaction, suggestions) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $phone, $satisfaction, $suggestions);

    // Set parameters
    $name = $_POST['uname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $satisfaction = $_POST['satisfy'];
    $suggestions = $_POST['msg'];

    // Execute SQL statement
    if ($stmt->execute()) {
        // Redirect to the same page with success parameter
        header("Location: {$_SERVER['PHP_SELF']}?success=true");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html> 
<html lang="en"> 

<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport"
        content="width=device-width,initial-scale=1.0"> 
    <title>Feedback Form</title> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> 
    <link rel="stylesheet" href="feedback_styles.css"> 
    <style>
        /* CSS for confirmation message */
        .confirmation-box {
            display: none;
            background-color: #f2f2f2;
            color: green;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
        }
    </style>
</head> 

<body> 
    <h1>Kool 7 Car Aircon Specialist</h1> 
    <h3 class="feed">Feedback Form</h3> 
    <div class="form-box"> 
        <div class="textup"> 
            <i class="fa fa-solid fa-clock"></i> 
            It only takes two minutes!! 
        </div> 
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> <!-- PHP_SELF is a PHP super global variable that returns the filename of the currently executing script. -->
            <label for="uname"> 
                <i class="fa fa-solid fa-user"></i> 
                Name 
            </label> 
            <input type="text" id="uname" name="uname" required> 

            <label for="email"> 
                <i class="fa fa-solid fa-envelope"></i> 
                Email Address 
            </label> 
            <input type="email" id="email" name="email" required> 

            <label for="phone"> 
                <i class="fa-solid fa-phone"></i> 
                Phone No 
            </label> 
            <input type="tel" id="phone" name="phone" required> 

            <label> 
                <i class="fa-solid fa-face-smile"></i> 
                Are you satisfied with our service? 
            </label> 
            <div class="radio-group"> 
                <input type="radio" id="yes" name="satisfy" value="yes" checked> 
                <label for="yes">Yes</label> 

                <input type="radio" id="no" name="satisfy" value="no"> 
                <label for="no">No</label> 
            </div> 

            <label for="msg"> 
                <i class="fa-solid fa-comments" style="margin-right: 3px;"></i> 
                Write your Suggestions: 
            </label> 
            <textarea id="msg" name="msg" rows="4" cols="10" required><?php if(isset($_POST['msg'])) { echo htmlspecialchars($_POST['msg']); } ?></textarea> <!-- Populate textarea with submitted value if form is submitted -->
            <button type="submit" name="submit"> <!-- Add name attribute for button to identify form submission -->
                Submit 
            </button> 
        </form> 
        <!-- Confirmation message box -->
        <div class="confirmation-box" id="confirmationBox">Feedback submitted successfully!</div>
    </div>
     
    <!-- "Back to Home" button -->
<a href="index.php" class="back-to-home-button" style="color: white;">Back to Home</a>


    <!-- JavaScript to show confirmation message -->
    <script>
        // Check if the page URL contains a success parameter (indicating successful form submission)
        const urlParams = new URLSearchParams(window.location.search);
        const success = urlParams.get('success');

        // If success parameter is present, show the confirmation box
        if (success === 'true') {
            document.getElementById('confirmationBox').style.display = 'block';
        }
    </script>
</body> 

</html>
