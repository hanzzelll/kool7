<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin: 20px 0;
            font-weight: bold;
            color: #343a40;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .btn-danger:hover {
            background-color: #b71c1c;
            border-color: #7f0000;
        }

        .table {
            margin: 20px auto;
            width: 80%;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-color: #2F3645;
        }

        .table th {
            background-color: #343a40;
            color: white;
            text-align: center;
            font-size: 16px;
        }

        .table td {
            text-align: center;
            vertical-align: middle;
            font-size: 14px;
        }

        .table tr:hover {
            background-color: #f1f1f1;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        /* Alternating row colors */
        .table tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .table tbody tr:nth-child(even) {
            background-color: lightgray;
        }

        .btn {
            font-size: 14px;
            padding: 5px 10px;
            margin: 0 5px;
        }

        .btn-primary {
            color: white;
        }

        .btn-danger {
            color: white;
        }

        .return-btn {
            display: inline-block;
            margin: 20px auto;
            background-color: #a10808;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            text-align: center;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .return-btn:hover {
            background-color: #870606;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .btnsec {
            display: flex;
            /* Use flexbox for alignment */
            justify-content: flex-end;
            /* Align items to the right */
            gap: 10px;
            /* Add space between the buttons */
            margin-bottom: 20px;
            /* Add space below the buttons */
            margin-right: 2%;
            
        }

        .btnsec button {
            margin-top: 3%;
            background-color: #2F3645;
            border-color: #2F3645;
            color: white;
        }

        .btnsec button:hover {
          
            background-color: white;
            border-color: #2F3645;
            color: #2F3645;
        }
    </style>

</head>

<body>
<div class="btnsec">
        
        <button class="btn" onclick="window.location.href='add_inventory.php';">Add New Item</button>
        <button class="btn" onclick="window.location.href='dashboard.php';">Return to Dashboard</button>

     
    </div>
    <h2>Inventory Management</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tool ID</th>
                <th>Category</th>
                <th>Tool Name</th>
                <th>Available Size</th>
                <th>Status</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "kool7_car_aircon_specialist";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Read operation
            $sql = "SELECT * FROM inventory";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . (isset($row["tool_id"]) ? $row["tool_id"] : "") . "</td>";
                    echo "<td>" . (isset($row["category"]) ? $row["category"] : "") . "</td>";
                    echo "<td>" . (isset($row["tool_name"]) ? $row["tool_name"] : "") . "</td>";
                    echo "<td>" . (isset($row["available_size"]) ? $row["available_size"] : "") . "</td>";
                    echo "<td>" . (isset($row["status"]) ? $row["status"] : "") . "</td>";
                    echo "<td>" . (isset($row["quantity"]) ? $row["quantity"] : "") . "</td>";
                    echo "<td>";
                    if (isset($row["tool_id"])) {
                        echo "<a href='update_inventory.php?id=" . $row["tool_id"] . "' class='btn btn-primary'>Update</a>";
                        echo "<button onclick='deleteItem(" . $row["tool_id"] . ")' class='btn btn-danger'>Delete</button>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No items found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>

   


    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript to handle deletion -->
    <script>
        function deleteItem(itemId) {
            if (confirm("Are you sure you want to delete this item?")) {
                window.location.href = 'delete_inventory.php?id=' + itemId;
            }
        }
    </script>

</body>

</html>