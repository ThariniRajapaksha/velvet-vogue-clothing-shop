<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: Admin Login Page.html");
    exit();
}
// Fetch the admin's name from the session
$admin_name = $_SESSION['admin_name'];

// Fetch sales data from the database
$query = "SELECT InvoiceDate, GrandTotal FROM invoice";
$result = mysqli_query($conn, $query);

// Prepare the data for the chart
$dates = [];
$sales = [];

while ($row = mysqli_fetch_assoc($result)) {
    $dates[] = $row['InvoiceDate'];
    $sales[] = $row['GrandTotal'];
}

$dates_json = json_encode($dates);
$sales_json = json_encode($sales);
// Fetch total orders
$orderQuery = "SELECT COUNT(*) AS totalOrders FROM track_order";
$orderResult = $conn->query($orderQuery);
$orderData = $orderResult->fetch_assoc();
$totalOrders = $orderData['totalOrders'];

// Fetch total products
$productQuery = "SELECT COUNT(*) AS totalProducts FROM product";
$productResult = $conn->query($productQuery);
$productData = $productResult->fetch_assoc();
$totalProducts = $productData['totalProducts'];

// Fetch total customers
$customerQuery = "SELECT COUNT(*) AS totalCustomers FROM customerregister";
$customerResult = $conn->query($customerQuery);
$customerData = $customerResult->fetch_assoc();
$totalCustomers = $customerData['totalCustomers'];

// Fetch net profit (example - you can adjust the calculation)
$profitQuery = "SELECT SUM(GrandTotal) AS netProfit FROM invoice";
$profitResult = $conn->query($profitQuery);
$profitData = $profitResult->fetch_assoc();
$netProfit = $profitData['netProfit'];

// Query to get the latest orders, ordered by OrderDate
$orderQuery = "SELECT * FROM track_order ORDER BY OrderDate DESC LIMIT 5";
$orderResult = $conn->query($orderQuery);

// Check if the query returns any rows
if ($orderResult->num_rows > 0) {
    $orders = $orderResult->fetch_all(MYSQLI_ASSOC);
} else {
    $orders = [];
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Admin Home Page.css">
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

    <div class="main-content">
        <header>
            <div class="admin-name">
                <p><i class="fa-solid fa-hands-praying"></i> Welcome, Velvet Vogue Admin Panel, Administrator  <?php echo htmlspecialchars($admin_name); ?></p>
            </div>
        </header>

        <div class="content">
            <div class="dashboard-cards">
                <div class="card">
                    <h3>Total Orders</h3>
                    <p><?php echo $totalOrders; ?></p>
                </div>
                <div class="card">
                    <h3>Total Products</h3>
                    <p><?php echo $totalProducts; ?></p>
                </div>
                <div class="card">
                    <h3>Total Customers</h3>
                    <p><?php echo $totalCustomers; ?></p>
                </div>
                <div class="card">
                    <h3>Net Profit</h3>
                    <p><?php echo number_format($netProfit, 2); ?> LKR</p>
                </div>
            </div>

            <div class="chart-container">
                <h2>Sales Statistics</h2>
                <canvas id="salesChart"></canvas>
            </div>

            <div class="table-container">
                <h2>Recent Orders</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Order Date</th>
                            <th>Expected Delivery</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($orders)): ?>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td>#<?php echo $order['TrackOrderID']; ?></td>
                                    <td><?php echo $order['ProductName']; ?></td>
                                    <td><?php echo $order['Email']; ?></td>
                                    <td><?php echo $order['Status']; ?></td>
                                    <td><?php echo $order['OrderDate']; ?></td>
                                    <td><?php echo $order['ExpectedDelivery']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No recent orders found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        const dates = <?php echo $dates_json; ?>;
        const sales = <?php echo $sales_json; ?>;

        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line', 
            data: {
                labels: dates,
                datasets: [{
                    label: 'Sales (Rs)',
                    data: sales, 
                    borderColor: '#e67e22', 
                    backgroundColor: 'rgba(230, 126, 34, 0.2)', 
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
