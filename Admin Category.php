<?php
session_start();
include 'db_config.php';

// Redirect to login if admin is not logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: Admin Login Page.html");
    exit();
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_subcategory'])) {
        $subCategoryName = $_POST['subcategory_name'];
        $stmt = $conn->prepare("INSERT INTO subcategory (SubCategoryName) VALUES (?)");
        $stmt->bind_param("s", $subCategoryName);
        $stmt->execute();
    } elseif (isset($_POST['add_category'])) {
        $categoryName = $_POST['category_name'];
        $genderID = $_POST['gender_id'];
        $imagePath = $_POST['image_path'];
        $stmt = $conn->prepare("INSERT INTO category (CategoryName, GenderID, image_path) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $categoryName, $genderID, $imagePath);
        $stmt->execute();
    } elseif (isset($_POST['add_categorysubcategory'])) {
        $categoryID = $_POST['category_id'];
        $subCategoryID = $_POST['subcategory_id'];
        $stmt = $conn->prepare("INSERT INTO categorysubcategory (CategoryID, SubCategoryID) VALUES (?, ?)");
        $stmt->bind_param("ii", $categoryID, $subCategoryID);
        $stmt->execute();
    } elseif (isset($_POST['delete_subcategory'])) {
        $subCategoryID = $_POST['subcategory_id'];
        $stmt = $conn->prepare("DELETE FROM subcategory WHERE SubCategoryID = ?");
        $stmt->bind_param("i", $subCategoryID);
        $stmt->execute();
    } elseif (isset($_POST['delete_category'])) {
        $categoryID = $_POST['category_id'];
        $stmt = $conn->prepare("DELETE FROM category WHERE CategoryID = ?");
        $stmt->bind_param("i", $categoryID);
        $stmt->execute();
    } elseif (isset($_POST['delete_categorysubcategory'])) {
        $mappingID = $_POST['mapping_id'];
        $stmt = $conn->prepare("DELETE FROM categorysubcategory WHERE ID = ?");
        $stmt->bind_param("i", $mappingID);
        $stmt->execute();
    }
}

// Fetch data from tables
$subcategories = $conn->query("SELECT * FROM subcategory")->fetch_all(MYSQLI_ASSOC);
$categories = $conn->query("SELECT * FROM category")->fetch_all(MYSQLI_ASSOC);
$categorySubcategories = $conn->query("SELECT * FROM categorysubcategory")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Admin Category.css">
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

    <main class="main-content">

        <!-- Category Section -->
        <section>
            <h2>Manage Categories</h2>
            <form method="POST">
                <input type="text" name="category_name" placeholder="Category Name" required>
                <input type="number" name="gender_id" placeholder="Gender ID (1=Men, 2=Women)" required>
                <input type="text" name="image_path" placeholder="Image Path" required>
                <button type="submit" name="add_category">Add Category</button>
            </form>
            <table>
                <thead>
                    <tr>
                        <th>CategoryID</th>
                        <th>CategoryName</th>
                        <th>GenderID</th>
                        <th>Image Path</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td><?= $category['CategoryID'] ?></td>
                            <td><?= $category['CategoryName'] ?></td>
                            <td><?= $category['GenderID'] ?></td>
                            <td><?= $category['image_path'] ?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="category_id" value="<?= $category['CategoryID'] ?>">
                                    <button type="submit" name="delete_category">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <!-- SubCategory Section -->
        <section>
            <h2>Manage SubCategories</h2>
            <form method="POST">
                <input type="text" name="subcategory_name" placeholder="SubCategory Name" required>
                <button type="submit" name="add_subcategory">Add SubCategory</button>
            </form>
            <table>
                <thead>
                    <tr>
                        <th>SubCategoryID</th>
                        <th>SubCategoryName</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($subcategories as $subcategory): ?>
                        <tr>
                            <td><?= $subcategory['SubCategoryID'] ?></td>
                            <td><?= $subcategory['SubCategoryName'] ?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="subcategory_id" value="<?= $subcategory['SubCategoryID'] ?>">
                                    <button type="submit" name="delete_subcategory">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <!-- CategorySubCategory Section -->
        <section>
            <h2>Manage Category-SubCategory Mapping</h2>
            <form method="POST">
                <select name="category_id" id="category_id" required>
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['CategoryID'] ?>">
                            <?= $category['CategoryName'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <select name="subcategory_id" id="subcategory_id" required>
                    <option value="">Select SubCategory</option>
                    <?php foreach ($subcategories as $subcategory): ?>
                        <option value="<?= $subcategory['SubCategoryID'] ?>">
                            <?= $subcategory['SubCategoryName'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <button type="submit" name="add_categorysubcategory">Add Mapping</button>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>SubCategory</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (isset($categorySubcategories)) {
                        foreach ($categorySubcategories as $mapping): 
                            if (isset($mapping['CategoryID']) && isset($mapping['SubCategoryID'])): 
                                $categoryName = 'Unknown';
                                foreach ($categories as $c) {
                                    if ($c['CategoryID'] == $mapping['CategoryID']) {
                                        $categoryName = $c['CategoryName'];
                                        break;
                                    }
                                }

                                $subcategoryName = 'Unknown';
                                foreach ($subcategories as $s) {
                                    if ($s['SubCategoryID'] == $mapping['SubCategoryID']) {
                                        $subcategoryName = $s['SubCategoryName'];
                                        break;
                                    }
                                }
                    ?>
                    <tr>
                        <td><?= $categoryName ?></td>
                        <td><?= $subcategoryName ?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="mapping_id" value="<?= $mapping['ID'] ?>">
                                <button type="submit" name="delete_categorysubcategory">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php 
                            endif;
                        endforeach;
                    }
                    ?>
                </tbody>
            </table>
        </section>

    </main>
</body>
</html>
