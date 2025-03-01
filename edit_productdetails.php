<?php
include 'db_config.php';

if (!isset($_GET['detail_id'])) {
    header("Location: Admin Product.php");
    exit();
}

$detail_id = $_GET['detail_id'];

// Fetch existing data
$fetch_detail_query = "SELECT * FROM `productdetails` WHERE DetailID = '$detail_id'";
$detail_result = $conn->query($fetch_detail_query);
if ($detail_result->num_rows > 0) {
    $detail = $detail_result->fetch_assoc();
} else {
    header("Location: Admin Product.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $size = $_POST['size'];
    $color = $_POST['color'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $promotion_percentage = $_POST['promotion_percentage'];

    $update_detail_query = "UPDATE `productdetails` SET 
                            Size = ?, 
                            Color = ?, 
                            Quantity = ?, 
                            Price = ?, 
                            PromotionPercentage = ? 
                            WHERE DetailID = ?";

    $stmt = $conn->prepare($update_detail_query);
    $stmt->bind_param("ssdddi", $size, $color, $quantity, $price, $promotion_percentage, $detail_id);

    if ($stmt->execute()) {
        header("Location: Admin Product.php");
        exit();
    } else {
        echo "Error updating detail: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="edit_productdetails.css">
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
                <li><a href="Admin Payments.php"><i class="fa-brands fa-paypal"></i> Payments</a></li>
                <li><a href="Admin Logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
            </ul>
        </nav>
        <div class="footer-bottom">
            <p><i class="fa-regular fa-at"></i> All rights reserved Velvet Vogue 2024</p>
        </div>
    </div>

    <div class="content">
        <h3>Edit Product Detail</h3>
        <form action="" method="POST">
            <div class="input-group">
                <label for="size">Size</label>
                <input type="text" name="size" value="<?php echo $detail['Size']; ?>" required><br>
            </div>
            <div class="input-group">
                <label for="color">Color</label>
                <input type="text" name="color" value="<?php echo $detail['Color']; ?>" required><br>
            </div>
            <div class="input-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" value="<?php echo $detail['Quantity']; ?>" required><br>
            </div>
            <div class="input-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" name="price" value="<?php echo $detail['Price']; ?>" required><br>
            </div>
            <div class="input-group">
                <label for="promotion_percentage">Promotion Percentage</label>
                <input type="number" step="0.01" name="promotion_percentage" value="<?php echo $detail['PromotionPercentage']; ?>" required><br>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
