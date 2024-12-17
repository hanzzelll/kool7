<?php
include 'conn.php';

if (isset($_POST['dashboard_update_client'])) {
    $client_id = mysqli_real_escape_string($conn, $_POST['client_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $car_model = mysqli_real_escape_string($conn, $_POST['car_model']);
    $year_model = mysqli_real_escape_string($conn, $_POST['year_model']);
    $preferred_service = mysqli_real_escape_string($conn, $_POST['preferred_service']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $additional_message = mysqli_real_escape_string($conn, $_POST['additional_message']);

    $query = "UPDATE appointments SET name='$name', email='$email', contact_number='$contact_number', car_model='$car_model', year_model='$year_model', preferred_service='$preferred_service', date='$date', time='$time', additional_message='$additional_message' WHERE id='$client_id'";
    
    if (mysqli_query($conn, $query)) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request!";
}
?>