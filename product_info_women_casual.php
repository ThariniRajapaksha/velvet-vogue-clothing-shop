<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Velvet Vogue Home Page</title>
        <link rel="stylesheet" href="product_info_women_casual.css">
        
        <!-- Font Awesome CDN link -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        
    </head>    
    
<body>
<!-- Header -->
<header>
    <div class="header-container">
        <div class="logo">
            <a href="Home Page.php">
                <img src="Images/Logo Velvet Vogue.png" alt="Logo">
            </a>
        </div>        
        <nav>
            <ul class="menu">
                <li class="dropdown">
                    <a href="#">Men <i class="fa-solid fa-person"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="Men Casual Wear.php">Casual Wear <i class="fa-solid fa-house-chimney"></i></a></li>
                        <li><a href="Men Formal Wear.php">Formal Wear <i class="fa-solid fa-briefcase"></i></a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#">Women <i class="fa-sharp fa-solid fa-person-dress"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="Women Casual Wear.php">Casual Wear <i class="fa-solid fa-house-chimney"></i></a></li>
                        <li><a href="Women Formal Wear.php">Formal Wear <i class="fa-solid fa-briefcase"></i></a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#">Get in Touch <i class="fa-solid fa-address-card"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="About Us.php">About Us <i class="fa-solid fa-address-card"></i></a></li>
                        <li><a href="Contact Us.php">Contact Us <i class="fa-solid fa-phone"></i></a></li>
                        <li><a href="Inquries.php">Inquiry <i class="fa-solid fa-message"></i></a></li>
                    </ul>
                </li>
                <li><a href="Promotion Page.php">Promotions <i class="fa-solid fa-rectangle-ad"></i></a></li>
                <li><a href="#">Shopping Cart <i class="fa-duotone fa-solid fa-cart-shopping"></i></a></li>
                <div class="user-profile">
                    <li class="dropdown">
                        <a href="#">User Profile <i class="fa-solid fa-user"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="Customer Details.php">Settings <i class="fa-solid fa-gear"></i></a></li>
                            <li><a href="logout.php">Logout <i class="fa-solid fa-right-from-bracket"></i></a></li>
                        </ul>
                    </li>
                </div>
            </ul>
        </nav>
          <!-- Display the user's full name and profile image -->
          <div class="header-user-info">
                <?php
                    if (isset($_SESSION['fullName'])): ?>
                        <span>Welcome, <?php echo htmlspecialchars($_SESSION['fullName']); ?></span>
                        
                        <?php
                        if (isset($_SESSION['profile_image'])) {
                            $profileImagePath = $_SESSION['profile_image'];
                            
                            echo "<!-- Debug: Profile Image Path: $profileImagePath -->"; 
                            
                            if (!file_exists($profileImagePath)) {
                                $profileImagePath = 'uploads/default-profile.jpg'; 
                            }
                        }
                        ?>

                    <img src="<?php echo htmlspecialchars($profileImagePath); ?>" alt="Profile Image" class="profile-img" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">

                <?php endif; ?>

             </div>

    </div>
</header>
<div class="product-cards-container">
    <?php
    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "velvetvogue"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;

    $sql = "SELECT 
                p.ProductID, 
                p.ProductName, 
                p.Image, 
                GROUP_CONCAT(DISTINCT pd.Size SEPARATOR ', ') AS Sizes,
                pd.Price, 
                pd.PromotionPercentage 
            FROM product p
            JOIN productdetails pd ON p.ProductID = pd.ProductID
            WHERE p.CategoryID = ?
            GROUP BY p.ProductID";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $category_id); 
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any products exist
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='product-card'>";
            echo "<img src='images/{$row['Image']}' alt='{$row['ProductName']}'>";
            echo "<h3>{$row['ProductName']}</h3>";
            echo "<p class='sizes'>Available Sizes: {$row['Sizes']}</p>";

            if (!empty($row['PromotionPercentage']) && $row['PromotionPercentage'] > 0) {
                $discountedPrice = $row['Price'] - ($row['Price'] * $row['PromotionPercentage'] / 100);
                echo "<p class='price'>";
                echo "<span class='original-price' style='text-decoration: line-through; color: gray;'>"
                    . "Rs. " . number_format($row['Price'], 2) . "</span>";
                echo " <span class='promotion-price' style='color: green; font-weight: bold;'>"
                    . "Rs. " . number_format($discountedPrice, 2) . " ({$row['PromotionPercentage']}% Off)</span>";
                echo "</p>";
            } else {
                echo "<p class='price'>Rs. " . number_format($row['Price'], 2) . "</p>";
            }

            echo "<a href='addToCart.php?product_id={$row['ProductID']}'>View</a>";
            echo "</div>";
        }
    } else {
        echo "<p>No products available in this category.</p>";
    }

    $stmt->close();
    $conn->close();
    ?>
</div>


    <!-- Footer -->
    <footer>
        <div class="footer-column">
            <img src="Images/Logo Velvet Vogue.png" alt="Logo">
        </div>
        <div class="footer-column">
            <h3>Help</h3>
            <a href="#">Contact Us</a><br>
            <a href="#">Inquiry</a>
        </div>
        <div class="footer-column">
            <h3>Company</h3>
            <a href="#">About Us</a>
        </div>
        <div class="footer-column">
            <h3>Shop</h3>
            <a href="#">Men</a><br>
            <a href="#">Women</a><br>
            <a href="#">New Arrival</a><br>
            <a href="#">Promotions</a>
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
            <a href="#">Terms of Use</a><br>
            <a href="#">Privacy Policy</a><br>
            <a href="#">Cookie Policy</a>
        </div>
        <div class="footer-bottom">
            <p><i class="fa-regular fa-at"></i> All rights reserved Velvet Vogue 2024</p>
        </div>
    </footer>
</body>
</html>