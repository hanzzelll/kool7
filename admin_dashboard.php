<?php
// Include database connection
include 'conn.php';

// Fetch client responses from the database
$sql = "SELECT * FROM appointments";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> <!-- Font Awesome CSS -->
<link href="admin_dashboard.css" rel="stylesheet"> <!-- Link to custom CSS file -->
</head>

<body>

<div class="container-fluid">
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light custom-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="record.php">Clients</a> <!-- Changed href to record.php -->
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main content area -->
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Clients
                        <a href="appointment-form.php" class="btn btn-light float-end"><i class="fas fa-plus"></i> Add Client</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
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
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(isset($result) && mysqli_num_rows($result) > 0) {
                                        while($appointments = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr>
                                                <td><?= $appointments['id']; ?></td>
                                                <td><?= $appointments['name']; ?></td>
                                                <td><?= $appointments['email']; ?></td>
                                                <td><?= $appointments['contact_number']; ?></td>
                                                <td><?= $appointments['car_model']; ?></td>
                                                <td><?= $appointments['year_model']; ?></td>
                                                <td><?= $appointments['preferred_service']; ?></td>
                                                <td><?= $appointments['date']; ?></td>
                                                <td><?= $appointments['time']; ?></td>
                                                <td><?= $appointments['additional_message']; ?></td>
                                                <td>
                                                    <a href="client_edit.php?id=<?= $appointments['id']; ?>"
                                                        class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                    <a href="client_view.php?id=<?= $appointments['id']; ?>"
                                                        class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                                    <form action="delete_client.php" method="POST"
                                                        class="d-inline">
                                                        <input type="hidden" name="delete_client"
                                                            value="<?= $appointments['id']; ?>">
                                                        <button type="submit" name="delete_client_btn"
                                                            class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='10'>No Record Found</td></tr>";
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>