<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: Admin Login Page.html");
    exit();
}

$admin_name = $_SESSION['admin_name'];

// Handle Add Product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $gender_id = $_POST['gender_id'];
    $category_id = $_POST['category_id'];
    $subcategory_id = $_POST['subcategory_id'];
    $image = $_POST['image']; 
    $type = $_POST['type'];
    $description = $_POST['description'];
    $is_promotion = $_POST['is_promotion'];

    
    $query = "INSERT INTO `product` (ProductID, ProductName, GenderID, CategoryID, SubCategoryID, Image, Type, Description, IsPromotion) 
              VALUES ('$product_id', '$product_name', '$gender_id', '$category_id', '$subcategory_id', '$image', '$type', '$description', '$is_promotion')";
    
    if ($conn->query($query)) {
       
        header("Location: Admin Product.php?success=1");
        exit();
    } else {
        
        header("Location: Admin Product.php?error=1");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_details'])) {
    $product_id = $_POST['product_id'];
    $size = $_POST['size'];
    $color = $_POST['color'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $promotion_percentage = $_POST['promotion_percentage'];


    $details_query = "INSERT INTO `productdetails` (ProductID, Size, Color, Quantity, Price, PromotionPercentage) 
                      VALUES ('$product_id', '$size', '$color', '$quantity', '$price', '$promotion_percentage')";

    if ($conn->query($details_query)) {
        header("Location: Admin Product.php?details_success=1");
        exit();
    } else {
        header("Location: Admin Product.php?details_error=1");
        exit();
    }
}

// Handle Delete Product
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $delete_details_query = "DELETE FROM `productdetails` WHERE ProductID = '$delete_id'";
    $conn->query($delete_details_query);

    $delete_product_query = "DELETE FROM `product` WHERE ProductID = '$delete_id'";
    if ($conn->query($delete_product_query)) {
        header("Location: Admin Product.php");
        exit();
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}

// Handle Delete Product Detail
if (isset($_GET['delete_detail_id'])) {
    $delete_detail_id = $_GET['delete_detail_id'];
    
    $delete_detail_query = "DELETE FROM `productdetails` WHERE DetailID = '$delete_detail_id'";
    if ($conn->query($delete_detail_query)) {
        header("Location: Admin Product.php");
        exit();
    } else {
        echo "Error deleting detail: " . $conn->error;
    }
}

// Fetch Products
$product_query = "SELECT * FROM `product`";
$products = $conn->query($product_query);

$detail_query = "SELECT * FROM `productdetails`";
$details = $conn->query($detail_query);

// Fetch Gender, Category, and Subcategory data
$gender_query = "SELECT * FROM `gender`";
$genders = $conn->query($gender_query);

$category_query = "SELECT * FROM `category`";
$categories = $conn->query($category_query);

$subcategory_query = "SELECT * FROM `subcategory`";
$subcategories = $conn->query($subcategory_query);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Admin Product.css">
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
     <!-- Main content -->
    <div class="main-content">
        <h2>Manage Products</h2>

        <!-- Add Product Form -->
        <h3>Add New Product</h3>
        <form action="Admin Product.php" method="POST">
            <input type="text" name="product_name" placeholder="Product Name" required><br>
            <input type="number" name="gender_id" placeholder="Gender ID" required><br>
            <input type="number" name="category_id" placeholder="Category ID" required><br>
            <input type="number" name="subcategory_id" placeholder="Subcategory ID" required><br>
            <input type="text" name="image" placeholder="Image Name (e.g., product.jpg)" required><br>
            <input type="text" name="type" placeholder="Product Type" required><br>
            <textarea name="description" placeholder="Product Description" required></textarea><br>
            <label for="is_promotion">Promotion:</label>
            <select name="is_promotion">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select><br>
            <button type="submit" name="add_product">Add Product</button>
        </form>

        <h3>Add Product Details</h3>
        <form action="Admin Product.php" method="POST">
            <input type="number" name="product_id" placeholder="Product ID" required><br>
            <input type="text" name="size" placeholder="Size (e.g., M, L)" required><br>
            <input type="text" name="color" placeholder="Color (e.g., Red, Blue)" required><br>
            <input type="number" name="quantity" placeholder="Quantity" required><br>
            <input type="number" step="0.01" name="price" placeholder="Price" required><br>
            <input type="number" step="0.01" name="promotion_percentage" placeholder="Promotion Percentage (0-100)" required><br>
            <button type="submit" name="add_details">Add Details</button>
        </form>
        


        <!-- Product Table -->
        <h3>Existing Products</h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>GenderID</th>
                        <th>CategoryID</th>
                        <th>SubCategoryID</th>
                        <th>Image</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Is Promotion</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($product = $products->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $product['ProductID']; ?></td>
                        <td><?php echo $product['ProductName']; ?></td>
                        <td><?php echo $product['GenderID']; ?></td>
                        <td><?php echo $product['CategoryID']; ?></td>
                        <td><?php echo $product['SubCategoryID']; ?></td>
                        <td><?php echo $product['Image']; ?></td>
                        <td><?php echo $product['Type']; ?></td>
                        <td><?php echo $product['Description']; ?></td>
                        <td><?php echo $product['IsPromotion'] == 1 ? 'Yes' : 'No'; ?></td>
                        <td>
                            <a href="edit_product.php?ProductID=<?php echo $product['ProductID']; ?>">Edit</a>
                            <a href="Admin Product.php?delete_id=<?php echo $product['ProductID']; ?>">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>

            </table>
        </div>
        <br>
        <h3>Product Details</h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Detail ID</th>
                        <th>Product ID</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Promotion Percentage</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($detail = $details->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $detail['DetailID']; ?></td>
                        <td><?php echo $detail['ProductID']; ?></td>
                        <td><?php echo $detail['Size']; ?></td>
                        <td><?php echo $detail['Color']; ?></td>
                        <td><?php echo $detail['Quantity']; ?></td>
                        <td><?php echo $detail['Price']; ?></td>
                        <td><?php echo $detail['PromotionPercentage']; ?>%</td>
                        <td>
                            <a href="edit_productdetails.php?detail_id=<?php echo $detail['DetailID']; ?>">Edit</a> |
                            <a href="Admin Product.php?delete_detail_id=<?php echo $detail['DetailID']; ?>" 
                            onclick="return confirm('Are you sure you want to delete this detail?');">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <br>
        <br>
        <br>
        <h2>Tables For Reference</h2>
        <div class="scrollable-table">
            <!-- Gender Table -->
            <h3>Gender</h3><br>
            <table>
                <thead>
                    <tr>
                        <th>Gender ID</th>
                        <th>Gender Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($gender = $genders->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $gender['GenderID']; ?></td>
                        <td><?php echo $gender['GenderName']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <br>

            <!-- Category Table -->
            <h3>Category</h3><br>
            <table>
                <thead>
                    <tr>
                        <th>Category ID</th>
                        <th>Category Name</th>
                        <th>Gender ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($category = $categories->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $category['CategoryID']; ?></td>
                        <td><?php echo $category['CategoryName']; ?></td>
                        <td><?php echo $category['GenderID']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <br>

            <!-- Subcategory Table -->
            <h3>Subcategory</h3><br>
            <table>
                <thead>
                    <tr>
                        <th>Subcategory ID</th>
                        <th>Subcategory Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($subcategory = $subcategories->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $subcategory['SubCategoryID']; ?></td>
                        <td><?php echo $subcategory['SubCategoryName']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    
</body>
</html>
