<?php
session_start(); // Start the session to access session variables
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Velvet Vogue</title>
    <link rel="stylesheet" href="About Us.css">

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

    <!-- About Us Content Section -->
    <section class="about-us-section">
        <div class="content-image">
            <div class="text-content">
                <h2>Our Story</h2><br>
                <p>Welcome to Velvet Vogue, where fashion meets elegance and style. Founded in 2023, Velvet Vogue was created with the vision of offering high-quality clothing that enhances confidence and celebrates individuality. Our team is passionate about bringing you the latest trends, timeless pieces, and luxurious fabrics that suit every occasion.</p>
            </div>
            <div class="image">
                <img src="Images/About Us 3.webp" alt="Velvet Vogue Clothing">
            </div>
        </div>

        <div class="image-content">
            <div class="image">
                <img src="Images/About Us 2.webp" alt="Velvet Vogue Fashion">
            </div>
            <div class="text-content">
                <h2>Our Collections</h2><br>
                <p>At Velvet Vogue, we cater to a variety of styles, ensuring that every customer finds something they love. From sophisticated formal wear to trendy casual outfits, our collection features:</p>
                <ul>
                    <li><strong>Men’s Fashion:</strong> Tops, bottoms, footwear, and outerwear designed to keep you stylish and comfortable.</li>
                    <li><strong>Women’s Fashion:</strong> Dresses, tops, bottoms, and shoes that suit every woman's unique style and personality.</li>
                </ul>
                <p>We constantly update our collections to reflect the latest trends, so you'll always find something fresh and exciting when you visit us.</p>
            </div>
        </div>

        <div class="content-image">
            <div class="text-content">
                <h2>Why Velvet Vogue?</h2><br>
                <p>We believe fashion should not only be about looking good but also about feeling good. That's why we offer carefully curated collections for both men and women, blending comfort with style. Whether you are dressing for a casual day out or a formal evening event, Velvet Vogue ensures you always look and feel your best.</p>
                <ul>
                    <li><strong>Quality Materials:</strong> Our clothing is made with premium fabrics that are comfortable, durable, and easy to care for.</li>
                    <li><strong>Fashion Forward:</strong> We stay ahead of the trends to provide you with the most stylish pieces, so you’re always looking your best.</li>
                    <li><strong>Customer-Centric:</strong> Your satisfaction is our top priority. Our friendly customer service team is here to help with anything you need.</li>
                    <li><strong>Sustainability:</strong> We are committed to offering sustainable fashion choices that minimize our environmental impact, without compromising on style.</li>
                </ul>
            </div>
            <div class="image">
                <img src="Images/About Us 1.webp" alt="Velvet Vogue Clothing">
            </div>
        </div>
    </section>

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
