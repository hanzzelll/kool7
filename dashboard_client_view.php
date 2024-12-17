<?php
include 'conn.php';

if (isset($_GET['id'])) {
    $client_id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM appointments WHERE id='$client_id'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $client = mysqli_fetch_array($query_run);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Client Details</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Client Details 
                            <a href="dashboard.php" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label>Name</label>
                            <p class="form-control"><?= $client['name']; ?></p>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <p class="form-control"><?= $client['email']; ?></p>
                        </div>
                        <div class="mb-3">
                            <label>Contact Number</label>
                            <p class="form-control"><?= $client['contact_number']; ?></p>
                        </div>
                        <div class="mb-3">
                            <label>Car Model</label>
                            <p class="form-control"><?= $client['car_model']; ?></p>
                        </div>
                        <div class="mb-3">
                            <label>Year Model</label>
                            <p class="form-control"><?= $client['year_model']; ?></p>
                        </div>
                        <div class="mb-3">
                            <label>Preferred Service</label>
                            <p class="form-control"><?= $client['preferred_service']; ?></p>
                        </div>
                        <div class="mb-3">
                            <label>Date</label>
                            <p class="form-control"><?= $client['date']; ?></p>
                        </div>
                        <div class="mb-3">
                            <label>Time</label>
                            <p class="form-control"><?= $client['time']; ?></p>
                        </div>
                        <div class="mb-3">
                            <label>Additional Message</label>
                            <p class="form-control"><?= $client['additional_message']; ?></p>
                        </div>
                        <!-- Add other fields here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
    } else {
        echo "<h4>No Such Id Found</h4>";
    }
}
?>