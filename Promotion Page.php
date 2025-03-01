<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Velvet Vogue Home Page</title>
        <link rel="stylesheet" href="Promotion Page.css">
        
        <!-- Font Awesome CDN link -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <script>
            function buyNow(productId) {
                window.location.href = "addToCart.php?product_id=" + productId;
            }
        </script>        
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

    <!-- Main Promotion Content -->
    <main>
        <section class="promotion-section">
            <h1>Our Promotions</h1><br>
            <div id="promotion-container" class="promotion-grid">
            </div>
        </section>
    </main>
    
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
        async function loadPromotions() {
            try {
                const response = await fetch('fetch_promotions.php'); 
                const promotions = await response.json(); 
    
                const promotionsContainer = document.querySelector('#promotion-container'); 
    
                promotionsContainer.innerHTML = '';
    
                promotions.forEach(promotion => {
                    const promotionCard = `
                        <div class="promotion-card">
                            <img src="Images/${promotion.Image}" alt="${promotion.ProductName}">
                            <h2>${promotion.ProductName}</h2>
                            <p><span class="original-price">Rs. ${promotion.OriginalPrice}</span> <br>
                               <span class="discounted-price">Rs. ${promotion.DiscountedPrice}</span></p>
                            <button onclick="buyNow(${promotion.ProductID})"><i class="fa-regular fa-eye"></i> View</button>
                        </div>
                    `;
                    promotionsContainer.innerHTML += promotionCard; 
                });
            } catch (error) {
                console.error('Error loading promotions:', error);
            }
        }
    
        window.onload = loadPromotions;
    </script>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const sizeDropdown = document.getElementById("product_size");
    const colorDropdown = document.getElementById("product_color");
    const priceDisplay = document.getElementById("product_price");

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