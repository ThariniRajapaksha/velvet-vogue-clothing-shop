<?php
session_start(); // Start the session
include 'db_config.php';

$error = ""; // Initialize an empty error variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and retrieve form data
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        // Query to retrieve admin details
        $stmt = $conn->prepare("SELECT AdminID, FullName, Password FROM adminregister WHERE Email = ?");
        if ($stmt === false) {
            $error = "Database error. Please try again later.";
        } else {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 0) {
                $error = "Invalid email or password.";
            } else {
                $stmt->bind_result($admin_id, $full_name, $hashed_password);
                $stmt->fetch();

                // Verify password
                if (password_verify($password, $hashed_password)) {
                    // Set session variables
                    $_SESSION['admin_id'] = $admin_id;
                    $_SESSION['admin_name'] = $full_name;

                    // Redirect to Admin Home Page
                    header("Location: Admin Home Page.php");
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
    <title>Velvet Vogue Admin Login Page</title>
    <link rel="stylesheet" href="Admin Login Page.css">
</head>
<body>
    <header>
        <nav class="admin-link">
            <a href="Login Page.php">Customer</a>
        </nav>
        <div class="logo">
            <img src="Images/Logo Velvet Vogue.png" alt="Logo">
        </div>
    </header>
    <main>
        <div class="login-container">
            <div class="login-left"></div>
            <div class="login-right">
                <h2>ADMIN LOGIN</h2>
                <form action="Admin Login Page.php" method="POST">
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email"
                               value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
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
                <p class="signup-link">Don’t have an account? <a href="Admin Register Page.php">Sign up</a></p>
            </div>
        </div>
    </main>
</body>
</html>
