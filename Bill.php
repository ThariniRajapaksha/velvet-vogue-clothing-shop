<?php
include('db_config.php'); 
$shippingProcessingFee = 250;
$tax = 520;

try {
    $conn->begin_transaction();

    // Fetch the latest shipping details
    $shippingQuery = "SELECT OrderID, full_name, email, address, city, country, postal_code 
                      FROM `shipping_details` 
                      ORDER BY id DESC LIMIT 1";
    $shippingResult = $conn->query($shippingQuery);

    if ($shippingResult->num_rows > 0) {
        $shipping = $shippingResult->fetch_assoc();
    } else {
        throw new Exception("Shipping details not found.");
    }

    // Fetch order details
    $orderQuery = "SELECT * FROM `order`";
    $orderResult = $conn->query($orderQuery);

    if ($orderResult->num_rows > 0) {
        $stmt = $conn->prepare("INSERT INTO `invoice` 
            (`OrderID`, `CustomerName`, `CustomerEmail`, `CustomerAddress`, `City`, `Country`, `PostalCode`, 
            `Subtotal`, `ShippingFee`, `Tax`, `GrandTotal`, `InvoiceDate`, `DueDate`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $invoiceDate = date('Y-m-d');
        $dueDate = date('Y-m-d', strtotime('+7 days'));

        $grandTotal = 0;

        while ($row = $orderResult->fetch_assoc()) {
            $orderID = $row['OrderID'];

            $checkQuery = "SELECT * FROM `invoice` WHERE `OrderID` = ?";
            $checkStmt = $conn->prepare($checkQuery);
            $checkStmt->bind_param('i', $orderID);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            if ($checkResult->num_rows > 0) {
                continue;
            }

            $subtotal = $row['TotalPrice'];
            $grandTotal = $subtotal + $shippingProcessingFee + $tax;

            $stmt->bind_param(
                'issssssdddsss',
                $orderID,
                $shipping['full_name'],
                $shipping['email'],
                $shipping['address'],
                $shipping['city'],
                $shipping['country'],
                $shipping['postal_code'],
                $subtotal,
                $shippingProcessingFee,
                $tax,
                $grandTotal,
                $invoiceDate,
                $dueDate
            );
            $stmt->execute();
        }

    } else {
        throw new Exception("No orders found in the order table.");
    }

    $conn->commit();
} catch (Exception $e) {
    $conn->rollback();
    echo "Error: " . $e->getMessage();
} finally {
    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Velvet Vogue Home Page</title>
    <link rel="stylesheet" href="Bill.css">
    <!-- Font Awesome CDN link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
<h1>Thank You For Shopping With Us...!</h1>
<div class="invoice-container">
    <header>
        <div class="logo">
            <img src="Images/Logo Velvet Vogue.png" alt="Velvet Vogue Logo">
        </div>
        <div class="company-info">
            <h2>Velvet Vogue</h2>
            <p>8 Rose Street,</p>
            <p>Colombo, Sri Lanka</p>
            <p>20000</p>
        </div>
    </header>

    <section class="invoice-details">
        <div>
            <h2>Invoice #</h2>
        </div>
        <div>
            <h2>Date</h2>
            <p><?php echo date('Y-m-d'); ?></p>
        </div>
        <div>
            <h2>Due Date</h2>
            <p><?php echo date('Y-m-d', strtotime('+7 days')); ?></p>
        </div>
    </section>

    <section class="billing-details">
    <h2>Bill To:</h2>
    <?php
    include 'db_config.php';

    $shippingQuery = "SELECT full_name, email, address, city, country, postal_code 
                      FROM `shipping_details` 
                      ORDER BY id DESC LIMIT 1";
    $shippingResult = $conn->query($shippingQuery);

    if ($shippingResult->num_rows > 0) {
        $shipping = $shippingResult->fetch_assoc();
        echo "<p>" . htmlspecialchars($shipping['full_name']) . "</p>";
        echo "<p>" . htmlspecialchars($shipping['email']) . "</p>";
        echo "<p>" . htmlspecialchars($shipping['address']) . "</p>";
        echo "<p>" . htmlspecialchars($shipping['city']) . ", " . htmlspecialchars($shipping['postal_code']) . "</p>";
        echo "<p>" . htmlspecialchars($shipping['country']) . "</p>";
    } else {
        echo "<p>No shipping details available</p>";
    }
    ?>
</section>



<table class="invoice-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'db_config.php';

            $grandTotal = 0;

            $query = "SELECT * FROM `order`";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['OrderID']}</td>
                        <td>{$row['ProductName']}</td>
                        <td>{$row['Quantity']}</td>
                        <td>{$row['Price']}</td>
                        <td>{$row['TotalPrice']}</td>
                    </tr>";
                    $grandTotal += $row['TotalPrice'];
                }
            } else {
                echo "<tr><td colspan='5'>No orders found</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>

    <!-- Section to display the calculated totals -->
    <section class="totals">
        <p>Subtotal: <?php echo number_format($grandTotal, 2); ?> LKR</p>
        <p>Shipping Fee: <?php echo number_format($shippingProcessingFee, 2); ?> LKR</p>
        <p>Tax: <?php echo number_format($tax, 2); ?> LKR</p>
        <p><strong>Grand Total: <?php echo number_format($grandTotal + $shippingProcessingFee + $tax, 2); ?> LKR</strong></p>
    </section>

    <section class="notes">
        <h3>Notes:</h3>
        <p>Thank you for shopping with Velvet Vogue! We appreciate your trust in us and look forward to serving you again.</p>
        <p>Please note that returns or exchanges are accepted within 14 days of delivery, subject to our return policy.</p>
        <p>Keep this invoice for your records.</p>
    </section>

    <footer class="invoice-footer">
        <p>Powered by Velvet Vogue</p>
    </footer>
</div>

<div class="button-container">
    <form action="Track Order.php" method="get">
        <button type="submit" class="track-order-button">Track Your Order Now</button>
    </form>
</div>
<br>
<br>
<!-- Footer -->
<footer>
        <div class="footer-column">
            <img src="Images/Logo Velvet Vogue.png" alt="Logo">
        </div>
        <div class="footer-column">
            <h3>Help</h3>
            <a href="Contact Us.php">Contact Us</a><br>
            <a href="Inquries.php">Inquiry</a>
        </div>
        <div class="footer-column">
            <h3>Company</h3>
            <a href="About Us.php#">About Us</a>
        </div>
        <div class="footer-column">
            <h3>Shop</h3>
            <a href="Men Casual Wear.php">Men</a><br>
            <a href="Women Casual Wear.php">Women</a><br>
            <a href="Home Page.php">New Arrival</a><br>
            <a href="Promotion Page.php">Promotions</a>
        </div>
        <div class="footer-column">
            <h3>Find Us on Social Media</h3>
            <a href="#"><i class="fa-brands fa-instagram"></i> Instagram</a><br>
            <a href="#"><i class="fa-brands fa-twitter"></i> X (formerly Twitter)</a><br>
            <a href="#"><i class="fa-brands fa-facebook"></i> Facebook</a><br>
            <a href="#"><i class="fa-brands fa-linkedin-in"></i> LinkedIn</a>
        </div>
        <div class="footer-column">
            <h3>Useful Links</h3>
            <a href="TermsOfUse.php">Terms of Use</a><br>
            <a href="PrivacyPolicy.php">Privacy Policy</a><br>
            <a href="CookiePolicy.php">Cookie Policy</a>
        </div>
        <div class="footer-bottom">
            <p><i class="fa-regular fa-at"></i> All rights reserved Velvet Vogue 2024</p>
        </div>
    </footer>
</body>
</html>
