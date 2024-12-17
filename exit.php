<?php
include 'conn.php';

if(isset($_POST['delete_client_btn'])) {
    // Check if delete_client value is set
    if(isset($_POST['delete_client'])) {
        $client_id = mysqli_real_escape_string($conn, $_POST['delete_client']);

        // Delete query
        $delete_query = "DELETE FROM appointments WHERE id='$client_id'";
        
        // Execute the query
        if(mysqli_query($conn, $delete_query)) {
            // Redirect to the same page to refresh the data
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    } else {
        echo "Client ID not provided for deletion.";
    }
}

// Initialize variables for search query and prepared statement
$search_query = "";
$stmt = null;
$sql_query = "SELECT * FROM appointments"; // Define $sql_query outside the conditional block

// Check if a search query is submitted
if(isset($_GET['search'])) {
    $search_query = $_GET['search'];

    // Prepare SQL query with placeholders
    $sql_query = "SELECT * FROM appointments WHERE name LIKE ? OR email LIKE ? OR 
                  car_model LIKE ? OR year_model LIKE ? OR preferred_service LIKE ? OR 
                  date LIKE ? OR time LIKE ? OR additional_message LIKE ?";
    $stmt = mysqli_prepare($conn, $sql_query);

    if (!$stmt) {
        echo "Failed to prepare statement: " . mysqli_error($conn);
        exit();
    }

    // Bind parameters
    $search_term = "%" . $search_query . "%"; // Add wildcards for like search
    mysqli_stmt_bind_param($stmt, "ssssssss", $search_term, $search_term, $search_term, 
                        $search_term, $search_term, $search_term, $search_term, $search_term);

    // Execute the statement
    if (!mysqli_stmt_execute($stmt)) {
        echo "Error executing statement: " . mysqli_stmt_error($stmt);
        exit();
    }

    // Get the result
    $result = mysqli_stmt_get_result($stmt);
} else {
    // Execute the default query
    $result = mysqli_query($conn, $sql_query);
    if (!$result) {
        echo "Error executing query: " . mysqli_error($conn);
        exit();
    }
}

?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> <!-- Font Awesome CSS -->
  <title>Client Records</title>
</head>
<body>
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Clients
              <a href="appointment-form.php" class="btn btn-primary float-end"><i class="fas fa-plus"></i> Add Client</a>
            </h4>
          </div>
          <div class="card-body">
            <!-- Search form -->
            <form action="" method="GET" class="mb-3">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search appointments" name="search" value="<?php echo $search_query; ?>">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
              </div>
            </form>
            <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th> <!-- Add this line for the ID column -->
                <th>Name</th>
                <th>Email</th>
                <th>Contact Number</th> <!-- Add this line for the Contact Number column -->
                <th>Car Model</th>
                <th>Year Model</th>
                <th>Preferred Service</th>
                <th>Date</th>
                <th>Time</th>
                <th>Additional Message</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if(mysqli_num_rows($result) > 0) {
                  while($appointments = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                      <td><?= $appointments['id']; ?></td> <!-- Display the ID -->
                      <td><?= $appointments['name']; ?></td>
                      <td><?= $appointments['email']; ?></td>
                      <td><?= $appointments['contact_number']; ?></td> <!-- Display the Contact Number -->
                      <td><?= $appointments['car_model']; ?></td>
                      <td><?= $appointments['year_model']; ?></td>
                      <td><?= $appointments['preferred_service']; ?></td>
                      <td><?= $appointments['date']; ?></td>
                      <td><?= $appointments['time']; ?></td>
                      <td><?= $appointments['additional_message']; ?></td>
                      <td>
                        <a href="client_edit.php?id=<?= $appointments['id']; ?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                        <a href="client_view.php?id=<?= $appointments['id']; ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                        <form action="" method="POST" class="d-inline">
                          <input type="hidden" name="delete_client" value="<?= $appointments['id']; ?>">
                          <button type="submit" name="delete_client_btn" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </form>
                      </td>
                    </tr>
                    <?php
                  }
                } else {
                  echo "<tr><td colspan='11'>No Record Found</td></tr>";
                }
              ?>
            </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
