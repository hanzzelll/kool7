<?php
// Include database connection
include 'conn.php';

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_COOKIE['username'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

// Function to determine status style
function getStatusStyle($status) {
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

    <!-- Header -->
    <header>
        <div class="logosec">
            <div class="logo">KOOL 7 CAR AIRCON SPECIALIST</div>
        </div>

        <div class="message">
            <div class="circle"></div>
            <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/8.png" class="icn" alt="">
            <div class="dp">
                <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210180014/profile-removebg-preview.png"
                    class="dpicn" alt="dp">
            </div>
        </div>
    </header>

    <div class="main-container">
        <!-- Navigation -->
        <div class="navcontainer">
            <nav class="nav">
                <div class="nav-upper-options">
                    <div class="nav-option option1">
                        <img src="dashboard.jpg"
                            class="nav-img" alt="dashboard">
                        <h3> Dashboard</h3>
                    </div>
                    <div class="nav-option option2" onmouseover="this.style.backgroundColor='#534c4c'" onmouseout="this.style.backgroundColor=''">
    <a href="inventory.php" style="text-decoration: none; color: #fff; display: flex; align-items: center;">
        <img src="inventory.jpg" class="nav-img" alt="articles">
        <h3 style="margin-left: 10px;">Inventory</h3>
    </a>
</div>

<div class="nav-option option5" onmouseover="this.style.backgroundColor='#534c4c'" onmouseout="this.style.backgroundColor=''">  
    <a href="edit_information.php" style="text-decoration: none; color: #fff;">
        <img src="edit.jpg" class="nav-img" alt="edit"> 
        <span style="margin-left: 10px; font-weight: bold; font-size: 16px;">Edit Information</span>
    </a>
</div>

<div class="nav-option option3" onmouseover="this.style.backgroundColor='#534c4c'" onmouseout="this.style.backgroundColor=''">
    <a href="approved.php" style="text-decoration: none; color: #fff;">
        <img src="check.jpg" class="nav-img" alt="archive">
        <span style="margin-left: 10px; font-weight: bold; font-size: 16px;">Approve</span>
    </a>
</div>

<div class="nav-option option3" onmouseover="this.style.backgroundColor='#534c4c'" onmouseout="this.style.backgroundColor=''">
    <a href="cancelled.php" style="text-decoration: none; color: #fff;">
        <img src="cancelled.jpg" class="nav-img" alt="archive">
        <span style="margin-left: 10px; font-weight: bold; font-size: 16px;">Cancelled</span>
    </a>
</div>

<div class="nav-option option3" onmouseover="this.style.backgroundColor='#534c4c'" onmouseout="this.style.backgroundColor=''">
    <a href="reschedule.php" style="text-decoration: none; color: #fff;">
        <img src="rescheduling.jpg" class="nav-img" alt="archive">
        <span style="margin-left: 10px; font-weight: bold; font-size: 16px;">Reschedule</span>
    </a>
</div>

<div class="nav-option option3" onmouseover="this.style.backgroundColor='#534c4c'" onmouseout="this.style.backgroundColor=''">
    <a href="archive.php" style="text-decoration: none; color: #fff;">
        <img src="archive.jpg" class="nav-img" alt="archive">
        <span style="margin-left: 10px; font-weight: bold; font-size: 16px;">Archive</span>
    </a>
</div>


 
                    <div class="nav-option logout">
                        <a href="logout.php" class="logout-link">
                            <img src="logout.jpg" class="nav-img" alt="logout">
                            <h3 class="logout-text">Logout</h3>
                        </a>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Main content -->
        <div class="main">
            <!-- Search bar -->
            <div class="searchbar">
                <input type="text" id="searchInput" placeholder="Search...">
                <select id="sortOptions">
                    <option value="">Sort in...</option>
                    <option value="asc">Ascending order (A-Z)</option>
                    <option value="desc">Descending order (Z-A)</option>
                </select>
            </div>

            <style>

.client-table thead th {
        text-align: center; /* Center-align the text in table header */
    }   
    
    .client-table td {
            text-align: center; /* Center-align the text in all td elements */
        }
    .stats-box {
        width: 200px; /* Adjust the width of each box */
        display: inline-block; /* Display boxes in a single line */
        margin-right: 50px; /* Space between boxes */
        padding: 10px;
        border: 1px solid #ccc; /* Border color */
        border-radius: 8px; /* Rounded corners */
        background-color: #3d3b3b; /* Background color */
        margin-top: 60px;
        margin-left: 35px;
        color: white;
    }

    .stats-box h3 {
        font-size: 14px;
        margin-bottom: 5px;
        text-align: center;
    }

    .stats-box p {
        font-size: 20px;
        font-weight: bold;
        margin: 0;
        text-align: center;
    }
</style>
            <!-- Statistic Panel -->
<div class="stats-panel">
    <div class="stats-box">
        <h3>Approved</h3>
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
                                        while($row = mysqli_fetch_assoc($result)) {
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

    <script>
        // JavaScript code for search functionality
        const searchInput = document.getElementById('searchInput');
        const sortOptions = document.getElementById('sortOptions');
        const rows = document.querySelectorAll('.client-table tbody tr');

        searchInput.addEventListener('input', function(event) {
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

        sortOptions.addEventListener('change', function(event) {
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
