<?php
// Include database configuration
include 'db_config.php';

$error = ""; // Initialize an empty error variable
$success = ""; // Initialize an empty success message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form data
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm-password']);

    // Validate form fields
    if (empty($fullname) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if email already exists
        $stmt = $conn->prepare("SELECT Email FROM adminregister WHERE Email = ?");
        if ($stmt === false) {
            $error = "Database error. Please try again later.";
        } else {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $error = "Email is already registered.";
            } else {
                // Insert admin data into the database
                $stmt->close();
                $stmt = $conn->prepare("INSERT INTO adminregister (FullName, Email, Password, CreatedAt) VALUES (?, ?, ?, NOW())");
                if ($stmt === false) {
                    $error = "Failed to prepare the registration query.";
                } else {
                    $stmt->bind_param("sss", $fullname, $email, $hashed_password);
                    if ($stmt->execute()) {
                        $success = "Registration successful! <a href='Admin Login Page.php'>Log in here</a>";
                    } else {
                        $error = "Error registering admin: " . $stmt->error;
                    }
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
    <title>Velvet Vogue Admin Registration Page</title>
    <link rel="stylesheet" href="Admin Register Page.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/Logo Velvet Vogue.png" alt="Logo">
        </div>
    </header>
    <main>
        <div class="login-container">
            <div class="login-left"></div>
            <div class="login-right">
                <h2>ADMIN REGISTER</h2>
                <form action="" method="POST">
                    <div class="input-group">
                        <label for="fullname">Full Name</label>
                        <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" 
                               value="<?php echo htmlspecialchars($_POST['fullname'] ?? ''); ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" 
                               value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="input-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>
                    </div>
                    <?php if (!empty($error)): ?>
                        <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>
                    <br>
                    <button type="submit" class="login-btn">Register</button>
                </form>
                <p class="signup-link">Already have an account? <a href="Admin Login Page.php">Log in</a></p>
            </div>
        </div>
    </main>
</body>
</html>
