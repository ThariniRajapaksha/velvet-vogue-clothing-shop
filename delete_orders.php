<?php
include('db_config.php');

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email']; 
} else {
    
    header('Location: login.php');
    exit();
}

$deleteOrderQuery = "
    DELETE FROM `order` 
    WHERE Email = '$email'";

if (mysqli_query($conn, $deleteOrderQuery)) {
} else {
    echo "Error deleting orders: " . mysqli_error($conn) . "<br>";
}

?>
