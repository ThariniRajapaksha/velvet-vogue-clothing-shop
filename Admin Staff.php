<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: Admin Login Page.html");
    exit();
}
// Fetch the admin's name from the session
$admin_name = $_SESSION['admin_name'];

// Handle Deletion of Admin Record
if (isset($_POST['delete_admin'])) {
    $admin_id = $_POST['admin_id'];
    $delete_query = "DELETE FROM adminregister WHERE AdminID = '$admin_id'";
    if (mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Admin record deleted successfully!');</script>";
        header("Location: Admin Home Page.php");
        exit();
    } else {
        echo "<script>alert('Error deleting record.');</script>";
    }
}

// Fetch the admin data from the database
$query = "SELECT * FROM adminregister";
$result = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Admin Staff.css">
    <!-- Font Awesome CDN link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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

    <!-- Main Content -->
    <div class="main-content">
            <h2>Admin Records</h2>

            <table>
                <thead>
                    <tr>
                        <th>Admin ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['AdminID']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['FullName']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['CreatedAt']) . "</td>";
                        echo "<td>
                            <form method='post'>
                                <input type='hidden' name='admin_id' value='" . htmlspecialchars($row['AdminID']) . "'>
                                <button type='submit' name='delete_admin' class='delete-btn'>Delete</button>
                            </form>
                        </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    
</body>
</html>
