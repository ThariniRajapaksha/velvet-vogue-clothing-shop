<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: Admin Login Page.html");
    exit();
}
// Fetch the admin's name from the session
$admin_name = $_SESSION['admin_name']; 

// Fetch shipping details
$query = "SELECT * FROM shipping_details";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Admin Shipping.css">
    <!-- Font Awesome CDN link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="sidebar">
        <div class="logo">
            <img src="Images/Logo Velvet Vogue.png" alt="Logo">
        </div>
        <nav>
            <ul>
                <li><a href="Admin Home Page.php"><i class="fa-solid fa-house-chimney"></i> Dashboard</a></li>
                <li><a href="Admin Product.php"><i class="fa-solid fa-boxes-stacked"></i> Products</a></li>
                <li><a href="Admin Order List.php"><i class="fa-solid fa-circle-check"></i> Orders</a></li>
                <li><a href="Admin Category.php"><i class="fa-solid fa-layer-group"></i> Category</a></li>
                <li class="dropdown">
                    <a href="#"><i class="fa-solid fa-user"></i> Customer <i class="fa-solid fa-caret-down"></i></a>
                    <div class="dropdown-content">
                        <a href="Admin Shipping.php"><i class="fa-solid fa-list-check"></i> Shipping Details</a>
                        <a href="Admin Customer Info.php"><i class="fa-solid fa-file-lines"></i> Customer Details</a>
                        <a href="Admin Messages.php"><i class="fa-solid fa-comment"></i> Customer Messages</a>
                        <a href="Admin Inquiries.php"><i class="fa-brands fa-wpforms"></i> Customer Inquiries</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="#"><i class="fa-solid fa-gear"></i> Settings <i class="fa-solid fa-caret-down"></i></a>
                    <div class="dropdown-content">
                        <a href="Admin Staff.php"><i class="fa-solid fa-users"></i> Staff Details</a>
                        <a href="Admin Password Change.php"><i class="fa-solid fa-lock"></i> Password Change</a>
                    </div>
                </li>
                <li><a href="Admin Payments.php"><i class="fa-brands fa-paypal"></i> Payments</a></li>
                <li><a href="Admin Logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
            </ul>
        </nav>
        <div class="footer-bottom">
            <p><i class="fa-regular fa-at"></i> All rights reserved Velvet Vogue 2024</p>
        </div>
    </div>

    <div class="main-content" style="margin-left: 270px; padding: 20px;">
        <h1>Shipping Details</h1>
        <div class="table-container">
            <table border="1" style="width: 100%; border-collapse: collapse; text-align: center;">
                <thead>
                    <tr style="background-color: #2d3436; color: white;">
                        <th>ID</th>
                        <th>OrderID</th>
                        <th>Grand Total</th>
                        <th>Full Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>City</th>
                        <th>Postal Code</th>
                        <th>Country</th>
                        <th>Payment Method</th>
                        <th>Card Name</th>
                        <th>Card Number</th>
                        <th>Expiry Date</th>
                        <th>CVV</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr id='row" . $row['id'] . "'>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . ($row['OrderID'] ?? 'N/A') . "</td>";
                            echo "<td>" . $row['grand_total'] . "</td>";
                            echo "<td>" . $row['full_name'] . "</td>";
                            echo "<td>" . $row['address'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['city'] . "</td>";
                            echo "<td>" . $row['postal_code'] . "</td>";
                            echo "<td>" . $row['country'] . "</td>";
                            echo "<td>" . $row['payment_method'] . "</td>";
                            echo "<td>" . ($row['card_name'] ?? 'N/A') . "</td>";
                            echo "<td>" . ($row['card_number'] ?? 'N/A') . "</td>";
                            echo "<td>" . ($row['expiry_date'] ?? 'N/A') . "</td>";
                            echo "<td>" . ($row['cvv'] ?? 'N/A') . "</td>";
                            
                        }
                    } else {
                        echo "<tr><td colspan='15'>No shipping details found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <script>
        function markAs(status, rowId) {
            document.getElementById('status' + rowId).innerText = status;
        }
    </script>

    
</body>
</html>
