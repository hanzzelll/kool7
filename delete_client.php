<?php
include 'conn.php';

if (isset($_POST['delete_client_btn'])) {
    $client_id = mysqli_real_escape_string($conn, $_POST['delete_client']);
    $query = "DELETE FROM appointments WHERE id='$client_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error deleting client: " . mysqli_error($conn);
    }
}
?>