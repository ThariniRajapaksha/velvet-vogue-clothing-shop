<?php
session_start();

include 'db_config.php';

// Ensure the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: Admin Login Page.html");
    exit();
}

// Fetch net profit (example - you can adjust the calculation)
$profitQuery = "SELECT SUM(GrandTotal) AS netProfit FROM invoice";
$profitResult = $conn->query($profitQuery);
$profitData = $profitResult->fetch_assoc();
$netProfit = $profitData['netProfit'];

// Query to fetch invoice details
$query = "SELECT * FROM invoice";
$result = $conn->query($query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Admin Payments.css">
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

    <div class="content">
        <h1>Invoice Details</h1>
        
        <!-- Table Container -->
        <div class="table-container">
            <table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>InvoiceID</th>
                        <th>OrderID</th>
                        <th>CustomerName</th>
                        <th>CustomerEmail</th>
                        <th>CustomerAddress</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>PostalCode</th>
                        <th>Subtotal</th>
                        <th>ShippingFee</th>
                        <th>Tax</th>
                        <th>GrandTotal</th>
                        <th>InvoiceDate</th>
                        <th>DueDate</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    mysqli_data_seek($result, 0);
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['InvoiceID'] . "</td>";
                        echo "<td>" . $row['OrderID'] . "</td>";
                        echo "<td>" . $row['CustomerName'] . "</td>";
                        echo "<td>" . $row['CustomerEmail'] . "</td>";
                        echo "<td>" . $row['CustomerAddress'] . "</td>";
                        echo "<td>" . $row['City'] . "</td>";
                        echo "<td>" . $row['Country'] . "</td>";
                        echo "<td>" . $row['PostalCode'] . "</td>";
                        echo "<td>" . $row['Subtotal'] . "</td>";
                        echo "<td>" . $row['ShippingFee'] . "</td>";
                        echo "<td>" . $row['Tax'] . "</td>";
                        echo "<td>" . $row['GrandTotal'] . "</td>";
                        echo "<td>" . $row['InvoiceDate'] . "</td>";
                        echo "<td>" . $row['DueDate'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <h2>Net Profit: <?php echo number_format($netProfit, 2); ?> LKR</h2>
    </div>


    
</body>
</html>
