<?php
session_start();
include('db_config.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cartID = $_POST['CartID'];

    $query = "DELETE FROM `shoppingcart` WHERE CartID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $cartID);

    if ($stmt->execute()) {
        header("Location: Cart.php"); 
        exit();
    } else {
        echo "Error removing item: " . $conn->error;
    }
}
?>
