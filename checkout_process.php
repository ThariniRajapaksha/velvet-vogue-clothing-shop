<?php
session_start();
include('db_config.php'); 

$email = $_SESSION['email']; 

// Fetch cart items
$query = "SELECT * FROM `shoppingcart` WHERE Email = '$email'";
$result = mysqli_query($conn, $query);

// Process each item and move to the `order` and `track_order` tables
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $cartID = $row['CartID'];
        $productName = $row['ProductName'];
        $quantity = $row['Quantity'];
        $price = $row['Price'];
        $totalPrice = $row['TotalPrice'];

       
        $orderInsertQuery = "
            INSERT INTO `order` (Email, CartID, ProductName, Quantity, Price, TotalPrice, OrderDate)
            VALUES ('$email', '$cartID', '$productName', '$quantity', '$price', '$totalPrice', NOW())
        ";
        mysqli_query($conn, $orderInsertQuery);

    }

    
    $clearCartQuery = "DELETE FROM `shoppingcart` WHERE Email = '$email'";
    mysqli_query($conn, $clearCartQuery);
}

header("Location: Shipping Details.php");
exit();
?>
