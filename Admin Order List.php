<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: Admin Login Page.html");
    exit();
}

$admin_name = $_SESSION['admin_name'];

// Fetch order data from the database
$query = "SELECT * FROM track_order";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Admin Order List.css">
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
        <h2>Order List</h2>

        <table class="order-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                    <th>Email</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Expected Delivery</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['TrackOrderID']; ?></td>
                        <td><?php echo $row['ProductName']; ?></td>
                        <td><?php echo $row['Quantity']; ?></td>
                        <td><?php echo $row['Price']; ?></td>
                        <td><?php echo $row['TotalPrice']; ?></td>
                        <td><?php echo $row['Email']; ?></td>
                        <td><?php echo $row['OrderDate']; ?></td>
                        <td>
                            <form method="POST" action="update_status.php">
                                <select name="status" class="status-dropdown">
                                    <option value="Pending" <?php if ($row['Status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                                    <option value="Process" <?php if ($row['Status'] == 'Process') echo 'selected'; ?>>Process</option>
                                    <option value="Shipped" <?php if ($row['Status'] == 'Shipped') echo 'selected'; ?>>Shipped</option>
                                    <option value="Delivered" <?php if ($row['Status'] == 'Delivered') echo 'selected'; ?>>Delivered</option>
                                </select>
                                <input type="hidden" name="order_id" value="<?php echo $row['TrackOrderID']; ?>">
                                <br>
                                <br>
                                <button type="submit" name="update_status">Update</button>
                            </form>
                        </td>
                        <td><?php echo $row['ExpectedDelivery']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    
</body>
</html>
