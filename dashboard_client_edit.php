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
    <title>Edit Client</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Client 
                            <a href="dashboard.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="dashboard_update_client.php" method="POST">
                            <input type="hidden" name="client_id" value="<?= $client_id ?>">
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="<?= $client['name'] ?>">
                            </div>
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="<?= $client['email'] ?>">
                            </div>
                            <div class="mb-3">
                                <label>Contact Number</label>
                                <input type="number" name="contact_number" class="form-control" value="<?= $client['contact_number'] ?>">
                            </div>
                            <div class="mb-3">
                                <label>Car Model</label>
                                <input type="text" name="car_model" class="form-control" value="<?= $client['car_model'] ?>">
                            </div>
                            <div class="mb-3">
                                <label>Year Model</label>
                                <input type="text" name="year_model" class="form-control" value="<?= $client['year_model'] ?>">
                            </div>
                            <div class="form__group">
                                <label for="service">Preferred Service:</label>
                                <select id="service" name="preferred_service" class="form-control">
                                    <option value="">-- Select a Service --</option>
                                    <option value="general" <?= $client['preferred_service'] == 'general' ? 'selected' : '' ?>>GENERAL SERVICES</option>
                                    <option value="diagnostics" <?= $client['preferred_service'] == 'diagnostics' ? 'selected' : '' ?>>CAR AIRCON DIAGNOSTICS SERVICES</option>
                                    <option value="cleaning" <?= $client['preferred_service'] == 'cleaning' ? 'selected' : '' ?>>CAR AIRCON CLEANING SERVICES</option>
                                    <option value="replacement" <?= $client['preferred_service'] == 'replacement' ? 'selected' : '' ?>>CAR AIRCON REPLACEMENT SERVICES</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Date</label>
                                <input type="date" name="date" class="form-control" value="<?= $client['date'] ?>">
                            </div>
                            <div class="mb-3">
                                <label>Time</label>
                                <input type="time" name="time" class="form-control" value="<?= $client['time'] ?>">
                            </div>
                            <div class="mb-3">
                                <label>Additional Message</label>
                                <input type="text" name="additional_message" class="form-control" value="<?= $client['additional_message'] ?>">
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="dashboard_update_client" class="btn btn-primary">Update Client</button>
                            </div>
                        </form>
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