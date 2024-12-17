<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Information</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        form {
            margin-bottom: 20px;
        }

        .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    width: 300px; /* Adjust width as needed */
    height: 200px; /* Adjust height as needed */
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}


        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
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
    $tables = array("about_us", "contact_info", "packages", "services", "testimonials");

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
                <form id="<?php echo $table . 'Form'; ?>" method="post">
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
                    <button type="button" onclick="submitUpdate('<?php echo $table . 'Form'; ?>')">Update</button>
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
            xhr.onreadystatechange = function() {
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

        // Function to submit update form
        function submitUpdate(formId) {
            var form = document.getElementById(formId);
            form.submit();
        }
    </script>
</body>
</html>
