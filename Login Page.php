<?php
session_start(); 

include 'db_config.php';

$error = ""; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        $stmt = $conn->prepare("SELECT FullName, Password FROM customerregister WHERE Email = ?");
        if ($stmt === false) {
            $error = "Database query failed.";
        } else {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 0) {
                $error = "Invalid email or password.";
            } else {
                $stmt->bind_result($fullName, $hashed_password);
                $stmt->fetch();

                if (password_verify($password, $hashed_password)) {
                    $_SESSION['fullName'] = $fullName;
                    $_SESSION['email'] = $email; 

                   
                    $stmt = $conn->prepare("SELECT profile_image FROM customer_details WHERE email = ?");
                    if ($stmt !== false) {
                        $stmt->bind_param("s", $email);
                        $stmt->execute();
                        $stmt->store_result();
                        if ($stmt->num_rows > 0) {
                            $stmt->bind_result($profile_image);
                            $stmt->fetch();
                            $_SESSION['profile_image'] = $profile_image;
                        } else {
                            $_SESSION['profile_image'] = 'uploads/default-profile.jpg';
                        }
                    }

                   
                    header("Location: Home Page.php");
                    exit();
                } else {
                    $error = "Invalid email or password.";
                }
            }
            $stmt->close();
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Velvet Vogue Login Page</title>
    <link rel="stylesheet" href="Login Page.css">
</head>
<body>
    <header>
        <nav class="admin-link">
            <a href="Admin Login Page.php">Administrator</a>
        </nav>
        <div class="logo">
            <img src="Images/Logo Velvet Vogue.png" alt="Logo">
        </div>
    </header>
    <main>
        <div class="login-container">
            <div class="login-left"></div>
            <div class="login-right">
                <h2>LOGIN</h2>
                <form action="Login Page.php" method="POST">                    
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <?php if (!empty($error)): ?>
                        <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>
                    <br>
                    <button type="submit" class="login-btn">Log In</button>
                </form>
                <p class="signup-link">Don’t have an account? <a href="Register Page.php">Sign up</a></p>
            </div>
        </div>
    </main>
</body>
</html>
