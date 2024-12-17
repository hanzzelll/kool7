
<?php
// for contact_info table
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "kool7_car_aircon_specialist";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select data from your table
$sql = "SELECT id, phone, address, email FROM contact_info";

// Execute the query
$result = $conn->query($sql);

// Close the connection
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
    <title>Kool 7 Car Aricon Specialist</title>
    <style>
      
.nav__links li a:hover {
 
  color: #c00427;
}

.nav__links li: hover {
  color: #c00427;
}
    </style>
  </head>
  <body>
    
    <header class="header">
      
      <nav class="nav__bar" id="navBar">
        <div class="logo nav__logo">
          <a href="#"><img src="logo 2.png" alt="logo"></a>
        </div>
        <div class="nav__menu__btn" id="menu-btn">
          <i class="ri-menu-3-line"></i>
        </div>
        <ul class="nav__links" id="nav-links">
          <li><a href="#home">HOME</a></li>
          <li><a href="#about">ABOUT</a></li>
          <li><a href="#service">SERVICES</a></li>
          <li><a href="#contactus">CONTACT US</a></li>
          <li><a href="#price">PACKAGES</a></li>
          <li><a href="#client">FEEDBACKS</a></li>
          <li><a href="order_unlog.php">AIR-CON PARTS</a></li>
          <li><a href="userlogin.php"><i class="fa fa-user" style="color:white"></i>   Log In</i></a></li>
        </ul>
      </nav>
    </header>


      

      <div class="section__container header__container" id="home">
        <div class="header__content">
          <h1>We Are Qualified & Professional</h1>
          <div class="header__btn">
            <a href="#about" class="btn btn--responsive">Read More</a>
          </div>
        </div>
      </div>
    </header>
    

    <section class="banner__container">
      <div class="banner__card">
        <h4>Cooling assurance or your refund guaranteed.</h4>
      </div>
      <div class="banner__card">
        <h4>Treating your car with the same care as you would.</h4>
      </div>
      <div class="banner__image">
        <img src="banner.jpg" alt="banner" />
      </div>
    </section>

    <section class="section__container experience__container" id="about">
      <div class="experience__image">
        <img src="experience.jpg" alt="experience" />
      </div>
      <div class="experience__content">
        <p class="section__subheader">WHO WE ARE</p>
        <?php

  
// Assuming you have already established a database connection
// Replace the placeholders with your actual database connection details
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

// Retrieve data from the 'about_us' table in the database
$sql = "SELECT * FROM about_us";
$result = $conn->query($sql);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<h2 class='section__header'>" . $row["title"] . "</h2>";
        echo "<p class='section__description'>" . $row["description"] . "</p>";
        echo "<a href='appointment-form.php' class='btn btn--responsive'>Book as Guest</a>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>

    </section>

    <section class="service" id="service">
    <div class="section__container service__container">
        <p class="section__subheader">WHY CHOOSE US</p>
        <h2 class="section__header">Great Car Services</h2>
        <p id="desc">
            Trust us to keep your cooling system running smoothly and reliably,
            ensuring comfort even in the hottest conditions.
        </p>
        <div class="service__grid">
            <?php
            // Database connection parameters
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "kool7_car_aircon_specialist";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL query to select titles, descriptions, and image paths from services table
            $sql = "SELECT title, description, image_path FROM services";

            // Execute the query
            $result = $conn->query($sql);

            // Check if there are results
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="service__card">';
                    echo '<img src="' . $row["image_path"] . '" alt="' . $row["title"] . '">';
                    echo '<h4>' . $row["title"] . '</h4>';
                    echo '<p>' . $row["description"] . '</p>';
                    echo '</div>';
                }
            } else {
                echo "0 results";
            }

            // Close the connection
            $conn->close();
            ?>
        </div>
    </div>
</section>


    

    <section class="customisation">
      <div class="section__container customisation__container">
        <p class="section__subheader">OUR CUSTOMIZATION</p>
        <h2 class="section__header">
          Air Conditioning Servicing Paired with Exceptional Craftsmanship
        </h2>
        <p class="section__description">
          Experience unparalleled craftsmanship tailored specifically for your car's 
          air conditioning system with our expert aircon servicing.
        </p>
      </div>
    </section>

    <section class="contact" id="contactus">
      <div class="section__container contact__container">
        <div class="contact__content">
          <p class="section__subheader">CONTACT US</p>
          <h2 class="section__header">Stay cool, stay comfortable with our air conditioning services.</h2>
          <p class="section__description">
            Experience the enhanced comfort as our meticulous care rejuvenates your car's air conditioning system, 
            ensuring peak performance and satisfaction.
          </p>
          <div class="contact__btns">
            <a href="#service" class="btn btn--responsive">Our Services</a>
            <a href="#footer" class="btn btn--responsive">Contact Us</a>
          </div>
        </div>
      </div>
    </section>
<?php
    // Include database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "kool7_car_aircon_specialist";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch prices from the database
$sql = "SELECT title, description, price FROM packages";
$result = $conn->query($sql);
?>

<section class="section__container price__container" id="price">
    <p class="section__subheader">PACKAGES</p>
    <h2 class="section__header">We offer a range of cost-effective and adaptable prices.</h2>
    <div class="price__grid-container" style="display: flex; justify-content: center;">
        <div class="price__grid" style="display: flex; flex-wrap: wrap;">
            <?php
            $package_index = 0; // Initialize package index
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $package_index++; // Increment package index
                    ?>
                    <div class="price__card" style="flex: 0 0 50%; max-width: calc(45% - 20px); margin: 0 10px 20px;">
                        <?php if ($package_index == 3) { ?>
                            <div class="price__card__ribbon">POPULAR CHOICE</div>
                        <?php } ?>
                        <h5><?php echo $row['title']; ?></h5>
                        <h4><sup></sup><?php echo $row['price']; ?></h4>
                        <p><?php echo nl2br($row['description']); ?></p>
                        <a href="appointment-form.php" class="btn btn--responsive">Book Now</a>
                        <p><strong>"The price varies depending on the brand of car and the year model."</strong></p>
                    </div>
                    <?php
                }
            } else {
                echo "No packages available.";
            }
            ?>
        </div>
    </div>
</section>







    

<?php
// Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kool7_car_aircon_specialist";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch testimonials from the database
$sql = "SELECT * FROM testimonials";
$result = $conn->query($sql);

?>

<section class="section__container testimonial__container" id="client">
    <p class="section__subheader">CLIENT TESTIMONIALS</p>
    <h2 class="section__header">100% Approved By Customers</h2>
    <!-- Slider main container -->
    <div class="swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="swiper-slide">';
                    echo '<div class="testimonial__card">';
                    echo '<img src="' . $row["image"] . '" alt="testimonial" />';
                    echo '<p>' . $row["content"] . '</p>';
                    echo '<h4>' . $row["author"] . '</h4>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "0 results";
            }
            ?>
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
    </div>
    <section class="section__container feedback__container">
        <div class="feedback__button">
        <a href="feedback.php" class="btn btn--responsive">Leave Feedback</a>
        </div>
    </section>
</section>

<?php
// Close the connection
$conn->close();
?>



    <section class="map-container">
      <!-- Embed Google Maps iframe with your location -->
      <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d775.1232351635333!2d121.3258414574697!3d14.055829360292276!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397a7bb50d03467%3A0xfb2c11d96f333a05!2sBrgy.%20Concepcion%2C%20San%20Pablo%20City%2C%20Laguna!5e0!3m2!1sen!2sph!4v1649437942454!5m2!1sen!2sph"
        allowfullscreen
        loading="lazy"
      ></iframe>
    </section>

    <footer class="footer" id="footer">
      <div class="section__container footer__container">
        <div class="footer__col">
        <?php
// Include database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "kool7_car_aircon_specialist";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch footer content from the database
$sql = "SELECT logo_path, description FROM footer_content";
$result = $conn->query($sql);

// Fetch the data
$row = $result->fetch_assoc();
$logo_path = $row['logo_path'];
$description = $row['description'];
?>

<div class="logo footer__logo">
    <a href="#"><img src="<?php echo $logo_path; ?>" alt="logo" /></a>
</div>
<p class="section__description">
    <?php echo $description; ?>
</p>

<?php
// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Example</title>
    <style>
        /* Style for the chat button */
        #chatbot-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 15px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 50%;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.3);
        }

        /* Initially hide the chat iframe */
        #chatbot-container {
            display: none;
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 300px;
            height: 400px;
            border: none;
            z-index: 9999;
        }
    </style>
</head>
<body>

    <!-- Chatbot Button -->
    <button id="chatbot-button">Chat</button>

    <!-- Hidden Chatbot iframe -->
    <div id="chatbot-container">
        <iframe src="https://www.chatbase.co/chatbot-iframe/L3Ttpj2z0lPLMfeV8oibu" width="100%" height="100%" frameborder="0"></iframe>
    </div>

    <script>
        // Get the button and chatbot container elements
        var chatbotButton = document.getElementById("chatbot-button");
        var chatbotContainer = document.getElementById("chatbot-container");

        // Toggle the visibility of the chatbot when the button is clicked
        chatbotButton.onclick = function() {
            if (chatbotContainer.style.display === "none" || chatbotContainer.style.display === "") {
                chatbotContainer.style.display = "block";
            } else {
                chatbotContainer.style.display = "none";
            }
        };
    </script>

</body>
</html>


          <ul class="footer__socials">
            <li>
              <a href="https://www.facebook.com/pages/Kool-7-Car-Aircon-Specialist/121817075029394"><i class="ri-facebook-fill"></i></a>
            </li>
          </ul>
        </div>
        <?php
// Include database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "kool7_car_aircon_specialist";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch services from the database
$sql = "SELECT service_name, service_link FROM general_services";
$result = $conn->query($sql);
?>

<div class="footer__col">
    <h4>Our Services</h4>
    <ul class="footer__links">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<li><a href="' . $row['service_link'] . '">' . $row['service_name'] . '</a></li>';
            }
        } else {
            echo "No services available.";
        }
        ?>
    </ul>
</div>

<?php
// Close the connection
$conn->close();
?>

        <div class="footer__col">
          <h4>Contact Info</h4>
          <ul class="footer__links">
            <li>
              <p>
                Feel the breeze of perfection with our precision car air conditioning service, 
                ensuring every ride is a cool, comfortable journey.
              </p>
            </li>
            <?php
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "kool7_car_aircon_specialist";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to select data from your_table
    $sql = "SELECT phone, address, email, hours FROM contact_info";

    // Execute the query
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of the first row
        $row = $result->fetch_assoc();
        ?>
        <div class="footer__col">
          <h4>Contact Info</h4>
          <ul class="footer__links">
            <li>
              <p>Phone: <span><?php echo $row["phone"]; ?></span></p>
            </li>
            <li>
              <p>Address: <span><?php echo $row["address"]; ?></span></p>
            </li>
            <li>
              <p>Email: <span><?php echo $row["email"]; ?></span></p>
            </li>
            <li>
              <p>Business Hours: <span><?php echo $row["hours"]; ?></span></p>
            </li>
          </ul>
        </div>
        <?php
    } else {
        echo "0 results";
    }

    // Close the connection
    $conn->close();
    ?>
      <script>
        // Get user's location using Geolocation API
        function getUserLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showUserLocation);
            } else {
                document.getElementById("userLocation").innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        
        // Display user's location
        function showUserLocation(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;
            const locationURL = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude},${longitude}&key=YOUR_API_KEY`;

            fetch(locationURL)
                .then(response => response.json())
                .then(data => {
                    const address = data.results[0].formatted_address;
                    document.getElementById("userLocation").innerHTML = `User Location: ${address}`;
                })
                .catch(error => {
                    console.error('Error fetching location:', error);
                    document.getElementById("userLocation").innerHTML = "Error fetching location.";
                });
        }

        // Call the function to get user's location
        getUserLocation();
    </script>
    </footer>
    <div class="footer__bar">
      Established: 1996
    </div>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="main.js"></script>

    
  </body>
</html>