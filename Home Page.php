<?php
session_start();
include 'db_config.php';

// Get filter values from the GET request
$categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';
$subcategoryFilter = isset($_GET['subcategory']) ? $_GET['subcategory'] : '';
$sizeFilter = isset($_GET['size']) ? $_GET['size'] : '';
$colorFilter = isset($_GET['color']) ? $_GET['color'] : '';
$minPrice = isset($_GET['min_price']) ? $_GET['min_price'] : '';
$maxPrice = isset($_GET['max_price']) ? $_GET['max_price'] : '';

// Construct the SQL query dynamically
$sql = "SELECT p.ProductID, p.ProductName, p.Image, pd.Size, pd.Color, pd.Price
        FROM product p
        JOIN productdetails pd ON p.ProductID = pd.ProductID
        WHERE 1=1";

$params = []; 
$types = '';  

if (!empty($categoryFilter)) {
    $sql .= " AND p.CategoryID = ?";
    $params[] = $categoryFilter;
    $types .= 'i'; 
}

if (!empty($subcategoryFilter)) {
    $sql .= " AND p.SubCategoryID = ?";
    $params[] = $subcategoryFilter;
    $types .= 'i';
}

if (!empty($sizeFilter)) {
    $sql .= " AND pd.Size = ?";
    $params[] = $sizeFilter;
    $types .= 's'; 
}

if (!empty($colorFilter)) {
    $sql .= " AND pd.Color = ?";
    $params[] = $colorFilter;
    $types .= 's'; 
}

if (!empty($minPrice)) {
    $sql .= " AND pd.Price >= ?";
    $params[] = $minPrice;
    $types .= 'd'; 
}

if (!empty($maxPrice)) {
    $sql .= " AND pd.Price <= ?";
    $params[] = $maxPrice;
    $types .= 'd'; 
}

$sql .= " ORDER BY p.ProductID DESC LIMIT 12"; 


$stmt = $conn->prepare($sql);
if ($params) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Velvet Vogue Home Page</title>
        <link rel="stylesheet" href="Home Page.css">
        
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


<div class="slider">
    <img src="Images/1.webp" alt="Slide 1">
    <img src="Images/2.webp" alt="Slide 2">
    <img src="Images/3.webp" alt="Slide 3">
    <img src="Images/4.webp" alt="Slide 4">
    <img src="Images/5.webp" alt="Slide 5">
    <div class="slider-text">
        <h1>FASHION STYLE</h1>
        <p>Look Our Products</p>
    </div>
</div>

<!-- Filter Section -->
<section class="filter-section">
    <h2><i class="fa-solid fa-filter"></i> Filter Products</h2>
    <form action="Home Page.php" method="GET">
        <div class="filter-item">
            <label for="category">Category</label>
            <select name="category" id="category">
                <option value="">Select Category</option>
                <?php
                $categoryQuery = "SELECT * FROM category";
                $categoryResult = $conn->query($categoryQuery);
                while ($category = $categoryResult->fetch_assoc()) {
                    echo '<option value="' . $category['CategoryID'] . '">' . $category['CategoryName'] . '</option>';
                }
                ?>
            </select>
        </div>
        
        <div class="filter-item">
            <label for="subcategory">Subcategory</label>
            <select name="subcategory" id="subcategory">
                <option value="">Select Subcategory</option>
                <?php
                $subcategoryQuery = "SELECT * FROM subcategory";
                $subcategoryResult = $conn->query($subcategoryQuery);
                while ($subcategory = $subcategoryResult->fetch_assoc()) {
                    echo '<option value="' . $subcategory['SubCategoryID'] . '">' . $subcategory['SubCategoryName'] . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="filter-item">
            <label for="size">Size</label>
            <select name="size" id="size">
                <option value="">Select Size</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
            </select>
        </div>

        <div class="filter-item">
            <label for="color">Color</label>
            <select name="color" id="color">
                <option value="">Select Color</option>
                <option value="Red">Red</option>
                <option value="Blue">Blue</option>
                <option value="Black">Black</option>
                <option value="White">White</option>
                <option value="Green">Green</option>
            </select>
        </div>

        <div class="filter-item">
            <label for="price">Price Range</label>
            <input type="number" name="min_price" id="min_price" placeholder="Min Price">
            <input type="number" name="max_price" id="max_price" placeholder="Max Price">
        </div>

        <button type="submit">Apply Filters</button>
    </form>
</section>


        <section class="new-products">
            <h2>Various Clothing & Accessories</h2>
            <div class="products-grid">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="product-card">';
                        echo '<img src="Images/' . $row['Image'] . '" alt="' . $row['ProductName'] . '" class="product-image">';
                        echo '<div class="product-info">';
                        echo '<h3 class="product-name">' . $row['ProductName'] . '</h3>';
                        echo '<p class="product-price">Rs. ' . number_format($row['Price'], 2) . '</p>';
                        echo '<p class="product-size-color">Size: ' . $row['Size'] . ' | Color: ' . $row['Color'] . '</p>';
                        echo "<a href='addToCart.php?product_id={$row['ProductID']}'>View</a>";  
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No new products available at the moment.</p>';
                }

                
                $conn->close();
                ?>
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

    <script>
        let slideIndex = 0; 
        const slides = document.querySelectorAll(".slider img"); 
    
        function showSlides() {
            slides.forEach(slide => slide.style.display = "none");
    
            slideIndex++;
            if (slideIndex > slides.length) { slideIndex = 1; }
    
            slides[slideIndex - 1].style.display = "block";
    
            setTimeout(showSlides, 3000);
        }
    
        showSlides();
    </script>
    <script>
        document.getElementById('category').addEventListener('change', function() {
        const categoryId = this.value;
        fetch(`getSubcategories.php?category=${categoryId}`)
            .then(response => response.json())
            .then(data => {
                const subcategorySelect = document.getElementById('subcategory');
                subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>'; 
                data.forEach(subcategory => {
                    const option = document.createElement('option');
                    option.value = subcategory.id;
                    option.textContent = subcategory.name;
                    subcategorySelect.appendChild(option);
                });
            });
        });

    </script>


</body>
</html>