<?php
include 'db_config.php';  

if (!isset($_GET['ProductID'])) {
    header("Location: Admin Product.php"); 
    exit();
}

$product_id = $_GET['ProductID'];

// Fetch existing data for the product
$fetch_product_query = "SELECT * FROM `product` WHERE ProductID = '$product_id'";
$product_result = $conn->query($fetch_product_query);
if ($product_result->num_rows > 0) {
    $product = $product_result->fetch_assoc();
} else {
    header("Location: Admin Product.php"); 
    exit();
}

// Handle form submission for updating product details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $gender_id = $_POST['gender_id'];
    $category_id = $_POST['category_id'];
    $subcategory_id = $_POST['subcategory_id'];
    $image = $_POST['image'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $is_promotion = isset($_POST['is_promotion']) ? 1 : 0;

    $update_query = "UPDATE `product` SET 
                     ProductName = ?, 
                     GenderID = ?, 
                     CategoryID = ?, 
                     SubCategoryID = ?, 
                     Image = ?, 
                     Type = ?, 
                     Description = ?, 
                     IsPromotion = ? 
                     WHERE ProductID = ?";

    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("siissssii", $product_name, $gender_id, $category_id, $subcategory_id, $image, $type, $description, $is_promotion, $product_id);

    if ($stmt->execute()) {
        header("Location: Admin Product.php");  
        exit();
    } else {
        echo "Error updating product: " . $conn->error;
    }

$product_id = $_GET['ProductID'];
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
        <h3>Edit Product Details</h3>
        <form action="" method="POST">
            <div class="input-group">
                <label for="product_name">Product Name</label>
                <input type="text" name="product_name" value="<?php echo $product['ProductName']; ?>" required><br>
            </div>
            <div class="input-group">
                <label for="gender_id">Gender</label>
                <input type="number" name="gender_id" value="<?php echo $product['GenderID']; ?>" required><br>
            </div>
            <div class="input-group">
                <label for="category_id">Category</label>
                <input type="number" name="category_id" value="<?php echo $product['CategoryID']; ?>" required><br>
            </div>
            <div class="input-group">
                <label for="subcategory_id">Sub Category</label>
                <input type="number" name="subcategory_id" value="<?php echo $product['SubCategoryID']; ?>" required><br>
            </div>
            <div class="input-group">
                <label for="image">Image</label>
                <input type="text" name="image" value="<?php echo $product['Image']; ?>" required><br>
            </div>
            <div class="input-group">
                <label for="type">Type</label>
                <input type="text" name="type" value="<?php echo $product['Type']; ?>" required><br>
            </div>
            <div class="input-group">
                <label for="description">Description</label>
                <textarea name="description" required><?php echo $product['Description']; ?></textarea><br>
            </div>
            <div class="input-group">
                <label for="is_promotion">Promotion</label>If you like to give a Promotion click on the box
                <input type="checkbox" name="is_promotion" <?php echo ($product['IsPromotion'] == 1) ? 'checked' : ''; ?>><br>
            </div>
            <button type="submit">Update Product</button>
        </form>
    </div>
</body>
</html>
