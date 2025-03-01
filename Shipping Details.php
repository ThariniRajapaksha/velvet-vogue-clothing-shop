<?php
session_start(); 
include('db_config.php'); 

$shippingProcessingFee = 250;
$tax = 520;

$userEmail = $_SESSION['email']; 

$query = "SELECT * FROM `order` WHERE Email = '$userEmail'";
$result = mysqli_query($conn, $query);

$totalPrice = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $totalPrice += $row['TotalPrice'];
}

$grandTotal = $totalPrice + $shippingProcessingFee + $tax;
$grandTotal = isset($_POST['grandTotal']) ? $_POST['grandTotal'] : $grandTotal;

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Velvet Vogue Home Page</title>
        <link rel="stylesheet" href="Shipping Details.css">
        
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
<br>
<br>

    <!-- Shipping Details Page -->
    <div class="container">
        <h1 class="page-title">Shipping Details</h1>
        <form action="submit_shipping.php" method="POST" class="shipping-form">
            <div class="form-group">
                <label for="grand-total">Grand Total</label>
                <input type="text" id="grand-total" name="grandTotal" value="Rs.<?php echo $grandTotal; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required placeholder="Enter your full name">
            </div>

            <div class="form-group">
                <label for="address">Shipping Address</label>
                <textarea id="address" name="address" rows="4" required placeholder="Enter your shipping address"></textarea>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" required placeholder="Enter your phone number">
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email address">
            </div>

            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" required placeholder="Enter your city">
            </div>

            <div class="form-group">
                <label for="postal">Postal Code</label>
                <input type="text" id="postal" name="postal" required placeholder="Enter your postal code">
            </div>

            <div class="form-group">
                <label for="country">Country</label>
                <select id="country" name="country" required>
                    <option>Select</option>
                    <option>Sri Lanka</option>
                </select>
            </div>

            <!-- Payment Method Section -->
        <div class="form-group">
            <label for="payment-method">Payment Method</label>
            <div class="payment-method">
                <label class="payment-option">
                    <input type="radio" name="payment_method" value="card" id="card-payment" required>
                    <span class="payment-icon"><i class="fa fa-credit-card"></i></span>
                    <span class="payment-label">Card Payment</span>
                </label>

                <label class="payment-option">
                    <input type="radio" name="payment_method" value="cod" id="cash-on-delivery">
                    <span class="payment-icon"><i class="fa fa-cash-register"></i></span>
                    <span class="payment-label">Cash on Delivery</span>
                </label>
            </div>
        </div>

        <!-- If card payment is selected, show card details (with modern design) -->
        <div class="card-details" id="card-details" style="display: none;">
            <img src="Images/Card.png" alt="Card Icon" class="card-icon" style="width: 300px; height: 80px; margin-right: 10px; vertical-align: middle;"><br>
            <br>
            <div class="form-group">
                <label for="card-name">Card Holder's Name</label>
                <input type="text" id="card-name" name="card-name" placeholder="Enter your card name" required />
            </div>
            <div class="form-group">
                <label for="card-number">Card Number</label>
                <input type="text" id="card-number" name="card_number" placeholder="Enter your card number" required />
            </div>
            <div class="form-group">
                <label for="expiry-date">Expiry Date</label>
                <input type="month" id="expiry-date" name="expiry_date" required />
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="Enter CVV" required />
            </div>
        </div>


        <button type="submit" class="submit-btn">Checkout</button>
        </form>
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
        document.addEventListener('DOMContentLoaded', function() {
    const cardPaymentRadio = document.getElementById('card-payment');
    const cardDetails = document.getElementById('card-details');
    const cashOnDeliveryRadio = document.getElementById('cash-on-delivery');
    const cardNumberInput = document.getElementById('card-number');
    
    cardDetails.style.display = 'none';

    cardPaymentRadio.addEventListener('change', function() {
        if (this.checked) {
            cardDetails.style.display = 'block'; 
        }
    });

    cashOnDeliveryRadio.addEventListener('change', function() {
        if (this.checked) {
            cardDetails.style.display = 'none'; 
        }
    });

    cardNumberInput.addEventListener('input', function() {
        let cardNumber = cardNumberInput.value.replace(/\D/g, ''); 
        
        if (cardNumber.length > 16) {
            cardNumber = cardNumber.slice(0, 16);
        }
        
        if (cardNumber.length > 4) {
            cardNumber = cardNumber.replace(/(\d{4})(?=\d)/g, '$1 '); 
        }
        
        cardNumberInput.value = cardNumber;
    });
});


    </script>
    <script>
    document.getElementById('cvv').addEventListener('input', function() {
    this.value = this.value.replace(/\D/g, ''); 
    if (this.value.length > 3) {
        this.value = this.value.slice(0, 3); 
    }
    });

    </script>
    

</body>
</html>

<?php
mysqli_close($conn);
?>