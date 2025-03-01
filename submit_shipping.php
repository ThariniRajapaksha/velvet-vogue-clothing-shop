<?php
include('db_config.php'); 

// Retrieve form data
$grandTotal = isset($_POST['grandTotal']) ? floatval($_POST['grandTotal']) : 0;
$fullName = mysqli_real_escape_string($conn, $_POST['name']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$city = mysqli_real_escape_string($conn, $_POST['city']);
$postal = mysqli_real_escape_string($conn, $_POST['postal']);
$country = mysqli_real_escape_string($conn, $_POST['country']);
$paymentMethod = mysqli_real_escape_string($conn, $_POST['payment_method']);

// Card payment details (optional)
$cardName = $cardNumber = $expiryDate = $cvv = NULL;
if ($paymentMethod == 'card') {
    $cardName = mysqli_real_escape_string($conn, $_POST['card-name']);
    $cardNumber = mysqli_real_escape_string($conn, $_POST['card_number']);
    
    if (isset($_POST['expiry_date']) && !empty($_POST['expiry_date'])) {
        $expiryDate = mysqli_real_escape_string($conn, $_POST['expiry_date']);
    }

    $cvv = mysqli_real_escape_string($conn, $_POST['cvv']);
}

// Prepare the SQL query to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO shipping_details 
                        (grand_total, full_name, address, phone, email, city, postal_code, country, payment_method, card_name, card_number, expiry_date, cvv) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if ($paymentMethod == 'card') {
    $stmt->bind_param("dsssssssssssd", $grandTotal, $fullName, $address, $phone, $email, $city, $postal, $country, $paymentMethod, $cardName, $cardNumber, $expiryDate, $cvv);
} else {
    $stmt->bind_param("dssssssssss", $grandTotal, $fullName, $address, $phone, $email, $city, $postal, $country, $paymentMethod, $cardName, $cardNumber);
}

if ($stmt->execute()) {
    $shippingId = $conn->insert_id;

    $orderQuery = "SELECT OrderID FROM `order` WHERE Email = ?";
    $orderStmt = $conn->prepare($orderQuery);
    $orderStmt->bind_param("s", $email);
    $orderStmt->execute();
    $orderResult = $orderStmt->get_result();

    if ($orderResult->num_rows > 0) {
        $orderRow = $orderResult->fetch_assoc();
        $orderId = $orderRow['OrderID'];

        $updateShippingQuery = "UPDATE shipping_details SET OrderID = ? WHERE id = ?";
        $updateShippingStmt = $conn->prepare($updateShippingQuery);
        $updateShippingStmt->bind_param("ii", $orderId, $shippingId);
        $updateShippingStmt->execute();
        $updateShippingStmt->close();
    } else {
        echo "No matching order found for the provided email.";
    }

    $orderStmt->close();

    echo "<script>
            alert('Shipping details saved successfully.');
            window.location.href = 'Bill.php';
          </script>";

    $orderQuery = "SELECT OrderID, ProductName, Quantity, Price, TotalPrice, Email, OrderDate FROM `order`";
    $result = $conn->query($orderQuery);

    if ($result->num_rows > 0) {
        $trackOrderStmt = $conn->prepare("INSERT INTO track_order 
                                          (ProductName, Quantity, Price, TotalPrice, Email, OrderDate, Status, ExpectedDelivery) 
                                          VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        $defaultStatus = "Pending";
        $expectedDelivery = date('Y-m-d', strtotime("+7 days"));

        while ($row = $result->fetch_assoc()) {
            $trackOrderStmt->bind_param(
                "sidsssss",
                $row['ProductName'],
                $row['Quantity'],
                $row['Price'],
                $row['TotalPrice'],
                $row['Email'],
                $row['OrderDate'],
                $defaultStatus,
                $expectedDelivery
            );
            $trackOrderStmt->execute();
        }
        $trackOrderStmt->close();
    } else {
        echo "No orders found in the order table.";
    }
}else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
