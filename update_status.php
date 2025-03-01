<?php
include('db_config.php');

if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $query = "UPDATE track_order SET Status = '$status' WHERE TrackOrderID = '$order_id'";
    
    if (mysqli_query($conn, $query)) {
        header('Location: Admin Order List.php?status=success');
    } else {
        header('Location: Admin Order List.php?status=error');
    }
}
?>
