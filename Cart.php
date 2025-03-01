<?php
session_start();
include('db_config.php'); 

$email = $_SESSION['email']; 
$query = "SELECT * FROM `shoppingcart` WHERE Email = '$email'";
$result = mysqli_query($conn, $query);

$shippingProcessingFee = 250;
$tax = 520;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Velvet Vogue Home Page</title>
        <link rel="stylesheet" href="Cart.css">
        
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
    
<!-- Shopping Cart Section -->
<div class="cart-container">
    <h1>My Shopping Cart</h1>
    <div class="cart-wrapper">
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>PromotionPercentage</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $grandTotal = 0; 
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $grandTotal += $row['TotalPrice']; 
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['ProductName']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Quantity']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Size']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Color']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['PromotionPercentage']) . "%</td>";
                        echo "<td> Rs." . htmlspecialchars(number_format($row['Price'], 2)) . "</td>";
                        echo "<td> Rs." . htmlspecialchars(number_format($row['TotalPrice'], 2)) . "</td>";
                        echo "<td>
                            <form method='post' action='remove_item.php'>
                                <input type='hidden' name='CartID' value='" . htmlspecialchars($row['CartID']) . "'>
                                <button type='submit' class='remove-btn'>Remove</button>
                            </form>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Your cart is empty.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
         <!-- Grand Total and Checkout Section -->
         <div class="cart-summary">
            <p>Subtotal:  Rs.<?php echo htmlspecialchars(number_format($grandTotal, 2)); ?></p>
            <p>Shipping & Processing Fee:  Rs.<?php echo number_format($shippingProcessingFee, 2); ?></p>
            <p>Tax:  Rs.<?php echo number_format($tax, 2); ?></p>
            <p><strong>Grand Total: </strong> Rs.<?php echo htmlspecialchars(number_format($grandTotal + $shippingProcessingFee + $tax, 2)); ?></p>

            <?php if ($grandTotal > 0): ?>
                <form action="checkout_process.php" method="post">
                    <input type="hidden" name="grandTotal" value="<?php echo htmlspecialchars($grandTotal + $shippingProcessingFee + $tax); ?>" />
                    <button type="submit" class="checkout-btn">Checkout</button>
                </form>

            <?php endif; ?>
        </div>
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

</body>
</html>