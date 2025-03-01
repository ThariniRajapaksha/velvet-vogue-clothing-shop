<?php
session_start();
include 'db_config.php';
// Get the product ID from the URL (e.g., addToCart.php?product_id=1)
if (isset($_GET['product_id'])) {
    $productID = $_GET['product_id'];
} else {
    echo "Product ID is missing.";
    exit;
}

// Fetch product details from the 'product' table
$productQuery = "SELECT * FROM product WHERE ProductID = ?";
$stmt = $conn->prepare($productQuery);
$stmt->bind_param("i", $productID);
$stmt->execute();
$productResult = $stmt->get_result();
$product = $productResult->fetch_assoc();

// Fetch the product details from the 'productdetails' table
$productDetailsQuery = "SELECT * FROM productdetails WHERE ProductID = ?";
$stmt2 = $conn->prepare($productDetailsQuery);
$stmt2->bind_param("i", $productID);
$stmt2->execute();
$productDetailsResult = $stmt2->get_result();
$productDetails = [];
while ($row = $productDetailsResult->fetch_assoc()) {
    $productDetails[] = $row;
}

// Handle Add to Cart action
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = $_POST['product_id'];
    $productQuantity = $_POST['product_quantity'];
    $productName = $product['ProductName']; 
    $promotionPercentage = 0;
    $price = 0;

    
    $_SESSION['cart'][] = [
        'product_id' => $productId,
        'quantity' => $productQuantity
    ];
    
    $price = 0;  
    $promotionPercentage = 0;

    foreach ($productDetails as $detail) {
        if ($detail['Size'] == $_POST['product_size'] && $detail['Color'] == $_POST['product_color']) {
            $price = $detail['Price'];
            $promotionPercentage = $detail['PromotionPercentage'];
            break;
        }
    }
    
    if ($price == 0) {
        echo "Price not available for the selected size and color.";
        exit;
    }


    if ($promotionPercentage > 0) {
        $discountedPrice = $price - ($price * ($promotionPercentage / 100));
        $productPrice = $discountedPrice;  
    } else {
        $productPrice = $price;
    }
    $totalPrice = $productPrice * $productQuantity;

    
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

    $insertQuery = "INSERT INTO shoppingcart (Email, ProductID, ProductName, Size, Color, PromotionPercentage, Quantity, Price, TotalPrice, DateAdded) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt4 = $conn->prepare($insertQuery);
    $stmt4->bind_param(
        "sisssisds",
        $email,
        $productId,
        $productName,
        $_POST['product_size'],
        $_POST['product_color'],
        $promotionPercentage,
        $productQuantity,
        $productPrice,
        $totalPrice
    );
    $stmt4->execute();

    echo "<script>
    if (confirm('Item added to cart. Do you want to visit the cart?')) {
        window.location.href = 'Cart.php';
    } else {
        window.location.href = 'Home Page.php';
    }
    </script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Velvet Vogue Home Page</title>
        <link rel="stylesheet" href="addToCart.css">
        
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
                <li><a href="Cart.php">Shopping Cart <i class="fa-duotone fa-solid fa-cart-shopping"></i></a></li>
                <div class="user-profile">
                    <li class="dropdown">
                        <a href="#">User Profile <i class="fa-solid fa-user"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="Customer Details.php">Settings <i class="fa-solid fa-gear"></i></a></li>
                            <li><a href="Password Change.php">Security <i class="fa-solid fa-user-lock"></i></a></li>
                            <li><a href="Track Order.php">Track Your Order <i class="fa-solid fa-map-location-dot"></i></a></li>
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


    <!-- Product Detail Section -->
    <div class="product-container">
        <div class="product-image">
            <img src="Images/<?php echo htmlspecialchars($product['Image']); ?>" alt="<?php echo htmlspecialchars($product['ProductName']); ?>">
        </div>
        <div class="product-details">
            <h1><?php echo htmlspecialchars($product['ProductName']); ?></h1>
            <p class="description"><?php echo htmlspecialchars($product['Description']); ?></p>

            <!-- Product Options -->
            <form action="" method="POST">
                <div class="quantity-container">
                    <label for="product_quantity">Quantity:</label>
                    <input type="number" id="product_quantity" name="product_quantity" value="1" min="1" required>
                </div>

                <div class="options-container">
                    <label for="product_size">Size:</label>
                    <select name="product_size" id="product_size">
                        <?php
                        foreach ($productDetails as $detail) {
                            echo "<option value='" . htmlspecialchars($detail['Size']) . "'>" . htmlspecialchars($detail['Size']) . "</option>";
                        }
                        ?>
                    </select>

                    <label for="product_color">Color:</label>
                    <select name="product_color" id="product_color">
                        <?php
                        foreach ($productDetails as $detail) {
                            echo "<option value='" . htmlspecialchars($detail['Color']) . "'>" . htmlspecialchars($detail['Color']) . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <br><p class="price">
                        <?php 
                        $price = 0;  
                        $promotionPercentage = 0;  
                        
                        foreach ($productDetails as $detail) {
                            
                            $price = $detail['Price'];
                            $promotionPercentage = $detail['PromotionPercentage'];  
                        }
                        
                        
                        if ($promotionPercentage > 0) {
                            $discountedPrice = $price - ($price * ($promotionPercentage / 100));
                            echo "<span class='original-price'><s>Rs. " . number_format($price, 2) . "</s></span> <br>"; 
                            echo "<span class='discounted-price'>Rs. " . number_format($discountedPrice, 2) . "</span>";
                        } else {
                            echo "Rs. " . number_format($price, 2);
                        }
                        ?>
                    </p>




                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($productID); ?>">
                    <br><button type="submit" class="add-to-cart-btn">Add to Cart</button>
            </form>
        </div>
    </div>

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

    <script>
document.addEventListener("DOMContentLoaded", function () {
    const sizeDropdown = document.getElementById("product_size");
    const colorDropdown = document.getElementById("product_color");
    const priceDisplay = document.getElementById("product_price");

    // Function to fetch and update the price
    function updatePrice() {
        const selectedSize = sizeDropdown.value;
        const selectedColor = colorDropdown.value;
        const productId = <?php echo json_encode($productID); ?>;

        
        fetch("fetch_price.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                product_id: productId,
                size: selectedSize,
                color: selectedColor
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const { price, promotionPercentage } = data;
                let finalPrice = price;

                
                if (promotionPercentage > 0) {
                    finalPrice = price - (price * (promotionPercentage / 100));
                    priceDisplay.innerHTML = `
                        <span class='original-price'><s>Rs. ${price.toFixed(2)}</s></span> <br>
                        <span class='discounted-price'>Rs. ${finalPrice.toFixed(2)}</span>
                    `;
                } else {
                    priceDisplay.textContent = `Rs. ${finalPrice.toFixed(2)}`;
                }
            } else {
                priceDisplay.textContent = "Price not available for the selected options.";
            }
        })
        .catch(error => {
            console.error("Error fetching price:", error);
            priceDisplay.textContent = "Error fetching price.";
        });
    }

    
    sizeDropdown.addEventListener("change", updatePrice);
    colorDropdown.addEventListener("change", updatePrice);
});
</script>

</body>
</html>