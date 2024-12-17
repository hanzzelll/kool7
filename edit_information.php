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
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Information</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap");


        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Roboto Condensed", sans-serif;
        }


        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #444;
            margin-top: 20px;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        td button {
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        td button:hover {
            background-color: #0056b3;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            width: 50%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close:hover {
            color: #333;
        }

        form input,
        form button {
            width: calc(100% - 20px);
            margin: 10px auto;
            display: block;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form button {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #218838;
        }

        .return-button {
            text-align: center;
            margin-top: 20px;
        }

        .return-button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #a10808;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .return-button a:hover {
            background-color: #7b0606;
        }

        @media (max-width: 768px) {
            table {
                width: 100%;
                font-size: 12px;
            }

            .modal-content {
                width: 90%;
            }
        }
    </style>
</head>

<body>
    <?php
    // Include database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "kool7_car_aircon_specialist";

    $conn = new mysqli($servername, $username, $password, $database);

    // Handle form submissions
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
        // Handle update operation
        $table = $_POST["table"];
        $id = $_POST["id"];
        $set_values = array();
        foreach ($_POST as $key => $value) {
            if ($key != "update" && $key != "table" && $key != "id") {
                $set_values[] = "$key='" . $conn->real_escape_string($value) . "'";
            }
        }
        $sql = "UPDATE $table SET " . implode(",", $set_values) . " WHERE id=$id";
        $conn->query($sql);
    }

    // Fetch data from each table and display CRUD forms
    $tables = array("about_us", "contact_info", "packages", "services", "testimonials", "footer_content", "general_services", "feedback");

    foreach ($tables as $table) {
        $sql = "SELECT * FROM $table";
        $result = $conn->query($sql);
        ?>

        <h2><?php echo ucwords(str_replace('_', ' ', $table)); ?></h2>

        <!-- Table to display records -->
        <table>
            <tr>
                <?php
                $sql_columns = "SHOW COLUMNS FROM $table";
                $result_columns = $conn->query($sql_columns);
                while ($row = $result_columns->fetch_assoc()) {
                    echo "<th>" . ucwords(str_replace('_', ' ', $row["Field"])) . "</th>";
                }
                ?>
                <th>Action</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $key => $value) {
                        echo "<td>$value</td>";
                    }
                    echo "<td>
                        <button onclick='openModal(\"$table\", " . $row["id"] . ")'>Update</button>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='" . ($result_columns->num_rows + 1) . "'>No records found</td></tr>";
            }
            ?>
        </table>

        <!-- Modal for update -->
        <div id="<?php echo $table . 'Modal'; ?>" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('<?php echo $table . 'Modal'; ?>')">&times;</span>
                <h2>Update <?php echo ucwords(str_replace('_', ' ', $table)); ?></h2>
                <form id="<?php echo $table . 'Form'; ?>" method="post" action="">
                    <input type="hidden" name="table" value="<?php echo $table; ?>">
                    <input type="hidden" name="id" id="<?php echo $table . 'Id'; ?>">
                    <?php
                    $sql_columns = "SHOW COLUMNS FROM $table";
                    $result_columns = $conn->query($sql_columns);
                    while ($row = $result_columns->fetch_assoc()) {
                        if ($row["Field"] != 'id') {
                            echo "<input type='text' name='" . $row["Field"] . "' id='" . $row["Field"] . "' placeholder='" . ucwords(str_replace('_', ' ', $row["Field"])) . "' required><br>";
                        }
                    }
                    ?>
                    <button type="submit" name="update">Update</button>
                </form>
            </div>
        </div>
        <?php
    }

    // Close database connection
    $conn->close();
    ?>

    <script>
        // Function to open modal
        function openModal(table, id) {
            var modal = document.getElementById(table + "Modal");
            modal.style.display = "block";
            document.getElementById(table + "Id").value = id;

            // Fetch data of selected record and populate form fields
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var data = JSON.parse(this.responseText);
                    for (var key in data) {
                        if (data.hasOwnProperty(key)) {
                            document.getElementById(key).value = data[key];
                        }
                    }
                }
            };
            xhr.open("GET", "fetch_record.php?table=" + table + "&id=" + id, true);
            xhr.send();
        }

        // Function to close modal
        function closeModal(modalId) {
            var modal = document.getElementById(modalId);
            modal.style.display = "none";
        }
    </script>

    <!-- Below the table -->
    <div style="text-align: center; margin-top: 20px;">
        <a href="dashboard.php"
            style="display: inline-block; padding: 10px 20px; background-color: #a10808; color: white; text-decoration: none; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">
            Return to Dashboard
        </a>
    </div>
</body>

</html>