<?php
// Include database connection
include 'conn.php';


// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_COOKIE['username'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

// Check if the user is logged in via session or cookie
$username = null;
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} elseif (isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];
}

// Redirect to login if no user is logged in
if (!$username) {
    header("Location: login.php");
    exit();
}


// Query to fetch user details
$sql_user = "SELECT username FROM adminlogin WHERE username = ?";
$stmt = mysqli_prepare($conn, $sql_user);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result_user = mysqli_stmt_get_result($stmt);

if ($result_user && mysqli_num_rows($result_user) > 0) {
    $row_user = mysqli_fetch_assoc($result_user);
    $logged_in_username = $row_user['username'];
} else {
    $logged_in_username = "Unknown User";
}
// Function to determine status style
function getStatusStyle($status)
{
    switch ($status) {
        case 'Approved':
            return 'background-color: #C6DBD5; color: white;';
        case 'Cancelled':
            return 'background-color: #F68D8E; color: white;';
        case 'Rescheduled':
            return 'background-color: 	#B6D0E2; color: white;';
        case 'Archived':
            return 'background-color: gray; color: white;';
        default:
            return ''; // No style for unknown status
    }
}

// Calculate the total sales amount
$total_sales_sql = "SELECT SUM(total_amount) AS total_sales FROM transactions";
$total_sales_result = $conn->query($total_sales_sql);
$total_sales = 0;

if ($total_sales_result->num_rows > 0) {
    $row = $total_sales_result->fetch_assoc();
    $total_sales = $row['total_sales'] ?? 0; // Default to 0 if null
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>


    <style>
        .client-table thead th {
            text-align: center;
            /* Center-align the text in table header */
        }

        .client-table td {
            text-align: center;
            /* Center-align the text in all td elements */
        }

        .stats-box {
            width: 200px;
            /* Adjust the width of each box */
            height: 150px;
            display: inline-block;
            /* Display boxes in a single line */
            margin-right: 50px;
            /* Space between boxes */
            padding: 10px;
            border: 1px solid #ccc;
            /* Border color */
            border-radius: 8px;
            /* Rounded corners */
            background-color: #3d3b3b;
            /* Background color */
            margin-top: 5%;
            margin-left: 9%;
            color: white;
            align-content: center;
        }

        .stats-box h3 {

            font-size: 30px;
            margin-bottom: 5%;
            text-align: center;
        }

        .stats-box p {
            font-size: 30px;
            font-weight: bold;
            margin: 0;
            text-align: center;
        }
    </style>

</head>

<body>

    <!-- Header -->
    <header>


        <div class="logosec">
            <img src="logo 2.png" alt="logo" height="60px">
            <div class="logo">KOOL 7 CAR AIRCON SPECIALIST</div>
        </div>

        <div class="message">
            <i class="fa fa-bell" style="color:white"></i>
            <div class="dp">
                <i class="fa fa-user" style="color:white"></i>
            </div>
        </div>


    </header>

    <div class="main-container">
        <!-- Navigation -->
        <div class="navcontainer">
            <nav class="nav">
                <div class="nav-upper-options">
                    <div class="nav-option option1">

                        <h3><i class="fa fa-bar-chart"></i> Dashboard</h3>
                    </div>
                    <div class="nav-option option2" onmouseover="this.style.backgroundColor='#a10808'"
                        onmouseout="this.style.backgroundColor=''">
                        <a href="inventory.php" style="text-decoration: none; color: #fff;">

                            <h3><i class="fa fa-clipboard"></i> Inventory</h3>
                        </a>
                    </div>

                    <div class="nav-option option5" onmouseover="this.style.backgroundColor='#a10808'"
                        onmouseout="this.style.backgroundColor=''">
                        <a href="edit_information.php" style="text-decoration: none; color: #fff;">

                            <h3><i class="fa fa-edit"></i> Edit Information</h3>
                        </a>
                    </div>

                    <div class="nav-option option3" onmouseover="this.style.backgroundColor='#a10808'"
                        onmouseout="this.style.backgroundColor=''">
                        <a href="approved.php" style="text-decoration: none; color: #fff;">

                            <h3><i class="fa fa-check"></i> Approved</h3>
                        </a>
                    </div>

                    <div class="nav-option option3" onmouseover="this.style.backgroundColor='#a10808'"
                        onmouseout="this.style.backgroundColor=''">
                        <a href="cancelled.php" style="text-decoration: none; color: #fff;">
                            <h3><i class="fa fa-remove"></i> Cancelled</h3>
                        </a>
                    </div>

                    <div class="nav-option option3" onmouseover="this.style.backgroundColor='#a10808'"
                        onmouseout="this.style.backgroundColor=''">
                        <a href="reschedule.php" style="text-decoration: none; color: #fff;">
                            <h3><i class="fa fa-calendar"></i> Rescheduled</h3>
                        </a>
                    </div>

                    <div class="nav-option option3" onmouseover="this.style.backgroundColor='#a10808'"
                        onmouseout="this.style.backgroundColor=''">
                        <a href="archive.php" style="text-decoration: none; color: #fff;">
                            <h3><i class="fa fa-archive"></i> Archive</h3>
                        </a>
                    </div>

                    <div class="nav-option option3" onmouseover="this.style.backgroundColor='#a10808'"
                        onmouseout="this.style.backgroundColor=''">
                        <a href="manage_parts.php" style="text-decoration: none; color: #fff;">
                            <h3><i class="manage_parts"></i> Manage Parts</h3>
                        </a>
                    </div>

                    <div class="nav-option option3" onmouseover="this.style.backgroundColor='#a10808'"
                        onmouseout="this.style.backgroundColor=''">
                        <a href="services_logs.php" style="text-decoration: none; color: #fff;">
                            <h3><i class="services_logs"></i> Services Logs</h3>
                        </a>
                    </div>

                    <div class="nav-option option3" onmouseover="this.style.backgroundColor='#a10808'"
                        onmouseout="this.style.backgroundColor=''">
                        <a href="transaction_logs.php" style="text-decoration: none; color: #fff;">
                            <h3><i class="transaction_logs"></i> Transaction Logs</h3>
                        </a>
                    </div>

                    <div class="nav-option option3" onmouseover="this.style.backgroundColor='#a10808'"
                        onmouseout="this.style.backgroundColor=''">
                        <a href="sales_report.php" style="text-decoration: none; color: #fff;">
                            <h3><i class="sales_report"></i> Sales Report</h3>
                        </a>
                    </div>

                    <div class="nav-option option3" onmouseover="this.style.backgroundColor='#a10808'"
                        onmouseout="this.style.backgroundColor=''">
                        <a href="certification.php" style="text-decoration: none; color: #fff;">
                            <h3><i class="certification"></i> Certification</h3>
                        </a>
                    </div>

                    <div class="nav-option logout" onmouseover="this.style.backgroundColor='#a10808'"
                        onmouseout="this.style.backgroundColor=''">
                        <a href="logout.php" class="logout-link">
                            <h3><i class="fa fa-sign-out"></i> Logout</h3>
                        </a>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Main content -->
        <div class="main">
            <br>
            <br>
            <h2>Welcome,
                <?php
                if ($username) {
                    echo "" . htmlspecialchars($logged_in_username);
                } else {
                    echo "No user is logged in.";
                }
                ?>
                !
            </h2>
            <!-- Statistic Panel -->
            <div class="stats-panel">
                <div class="stats-box">
                    <h3>Booked</h3>
                    <p>
                        <?php
                        // Count the number of approved appointments
                        $sql_approved_count = "SELECT COUNT(*) AS approved_count FROM appointments WHERE status = 'Approved'";
                        $result_approved_count = mysqli_query($conn, $sql_approved_count);
                        $row_approved_count = mysqli_fetch_assoc($result_approved_count);
                        echo $row_approved_count['approved_count'];
                        ?>
                    </p>
                </div>
                <div class="stats-box">
                    <h3>Cancelled</h3>
                    <p>
                        <?php
                        // Count the number of cancelled appointments
                        $sql_cancelled_count = "SELECT COUNT(*) AS cancelled_count FROM appointments WHERE status = 'Cancelled'";
                        $result_cancelled_count = mysqli_query($conn, $sql_cancelled_count);
                        $row_cancelled_count = mysqli_fetch_assoc($result_cancelled_count);
                        echo $row_cancelled_count['cancelled_count'];
                        ?>
                    </p>
                </div>

                <div class="stats-box">
                    <h3>Rescheduled</h3>
                    <p>
                        <?php
                        // Count the number of rescheduled appointments
                        $sql_rescheduled_count = "SELECT COUNT(*) AS rescheduled_count FROM appointments WHERE status = 'Rescheduled'";
                        $result_rescheduled_count = mysqli_query($conn, $sql_rescheduled_count);
                        $row_rescheduled_count = mysqli_fetch_assoc($result_rescheduled_count);
                        echo $row_rescheduled_count['rescheduled_count'];
                        ?>
                    </p>
                </div>

                <div class="stats-box">
                    <h3>Archived</h3>
                    <p>
                        <?php
                        // Count the number of archived appointments
                        $sql_archived_count = "SELECT COUNT(*) AS archived_count FROM appointments WHERE status = 'Archived'";
                        $result_archived_count = mysqli_query($conn, $sql_archived_count);
                        $row_archived_count = mysqli_fetch_assoc($result_archived_count);
                        echo $row_archived_count['archived_count'];
                        ?>
                    </p>
                </div>


                <div class="stats-box">
                <h3>Total Sales</h3>
                <p>₱<?php echo number_format($total_sales, 2); ?></p>
                </div>

                <div class="stats-box">
                    <h3>Customers</h3>
                    <p>
                        <?php
                        // Count the number of customers
                        $sql_name_count = "SELECT COUNT(*) AS name_count FROM appointments";
                        $result_name_count = mysqli_query($conn, $sql_name_count);
                        $row_name_count = mysqli_fetch_assoc($result_name_count);
                        echo $row_name_count['name_count'];
                        ?>
                    </p>
                </div>


            </div>

            <!-- Search bar -->
            <div>
                <div class="searchbar">
                    <div>
                        <input type="text" id="searchInput" placeholder="Search...">


                        <select id="sortOptions">
                            <option value="">Sort in...</option>
                            <option value="asc">Ascending order (A-Z)</option>
                            <option value="desc">Descending order (Z-A)</option>
                        </select>
                    </div>
                </div>

                <!-- Client Records -->
                <div class="report-container">
                    <!-- Report header -->
                    <div class="report-header">
                        <h1 class="recent-Articles">Client Records</h1>
                        <form action="exit.php">
                            <button type="submit" class="view">View All</button>
                        </form>
                    </div>

                    <!-- Report body -->
                    <div class="report-body">
                        <div class="client-table-wrapper">
                            <table class="client-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact Number</th>
                                        <th>Car Model</th>
                                        <th>Year Model</th>
                                        <th>Preferred Service</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Additional Message</th>
                                        <th>Status</th> <!-- New column for status -->
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Include database connection
                                    include 'conn.php';
                                    // Fetch all client records from the database
                                    $sql = "SELECT * FROM appointments";
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr>';
                                            echo '<td>' . $row['id'] . '</td>'; // Display ID
                                            echo '<td>' . $row['name'] . '</td>';
                                            echo '<td>' . $row['email'] . '</td>';
                                            echo '<td>' . $row['contact_number'] . '</td>';
                                            echo '<td>' . $row['car_model'] . '</td>';
                                            echo '<td>' . $row['year_model'] . '</td>';
                                            echo '<td>' . $row['preferred_service'] . '</td>';
                                            echo '<td>' . $row['date'] . '</td>';
                                            echo '<td>' . $row['time'] . '</td>';
                                            echo '<td>' . $row['additional_message'] . '</td>';
                                            echo '<td style="' . getStatusStyle($row['status']) . '">' . $row['status'] . '</td>'; // Display status with inline style
                                            echo '<td>
                                                <!-- Approved button -->
                                                <form action="approved.php" method="POST" class="d-inline">
                                                    <input type="hidden" name="approved_client" value="' . $row['id'] . '">
                                                    <button type="submit" name="approved_client_btn" class="btn btn-success btn-sm">Approved</button>
                                                </form>
                                                <!-- Cancelled button -->
                                                <form action="cancelled.php" method="POST" class="d-inline">
                                                    <input type="hidden" name="cancelled_client" value="' . $row['id'] . '">
                                                    <button type="submit" name="cancelled_client_btn" class="btn btn-danger btn-sm">Cancelled</button>
                                                </form>
                                                <!-- Reschedule button -->
                                                <form action="reschedule.php" method="POST" class="d-inline">
                                                    <input type="hidden" name="reschedule_client" value="' . $row['id'] . '">
                                                    <button type="submit" name="reschedule_client_btn" class="btn btn-warning btn-sm">Reschedule</button>
                                                </form>
                                                <!-- Archive button -->
                                                <form action="archive.php" method="POST" class="d-inline">
                                                    <input type="hidden" name="archive_client" value="' . $row['id'] . '">
                                                    <button type="submit" name="archive_client_btn" class="btn btn-secondary btn-sm">Archive</button>
                                                </form>
                                            </td>'; // Buttons for edit, view, and delete
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo "<tr><td colspan='12'>No client records found.</td></tr>"; // colspan updated to 12 for ID and status columns
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        // JavaScript code for search functionality
        const searchInput = document.getElementById('searchInput');
        const sortOptions = document.getElementById('sortOptions');
        const rows = document.querySelectorAll('.client-table tbody tr');

        searchInput.addEventListener('input', function (event) {
            const searchTerm = event.target.value.toLowerCase();
            const selectedOption = sortOptions.value;

            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                let found = false;
                cells.forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(searchTerm)) {
                        found = true;
                    }
                });
                if (found) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            if (selectedOption) {
                sortRows(selectedOption === 'asc');
            }
        });

        sortOptions.addEventListener('change', function (event) {
            const selectedOption = event.target.value;
            if (selectedOption) {
                sortRows(selectedOption === 'asc');
            }
        });

        function sortRows(ascending) {
            const rowsArray = Array.from(rows);
            const sortedRows = rowsArray.sort((rowA, rowB) => {
                const textA = rowA.cells[1].textContent.toLowerCase().trim();
                const textB = rowB.cells[1].textContent.toLowerCase().trim();
                return ascending ? textA.localeCompare(textB) : textB.localeCompare(textA);
            });

            sortedRows.forEach(row => {
                row.parentNode.appendChild(row); // Re-append sorted rows
            });
        }
    </script>
</body>

</html>
