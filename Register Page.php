<?php
include 'db_config.php';

$error = ""; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm-password']);


    if (empty($fullname) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("SELECT Email FROM customerregister WHERE Email = ?");
        if ($stmt === false) {
            $error = "Database error. Please try again.";
        } else {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $error = "Email is already registered.";
            } else {
                $stmt = $conn->prepare("INSERT INTO customerregister (FullName, Email, Password, ConfirmPassword) VALUES (?, ?, ?, ?)");
                if ($stmt === false) {
                    $error = "Database error. Please try again.";
                } else {
                    $stmt->bind_param("ssss", $fullname, $email, $hashed_password, $hashed_password);
                    if ($stmt->execute()) {
                        header("Location: Login Page.php");
                        exit();
                    } else {
                        $error = "Error: " . $stmt->error;
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
    <title>Velvet Vogue Registration Page</title>
    <link rel="stylesheet" href="Register Page.css">
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
                <h2>REGISTER</h2>
                <form action="Register Page.php" method="POST">
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
                
                <p class="signup-link">Already have an account? <a href="Login Page.php">Log in</a></p>
            </div>
        </div>
    </main>
</body>
</html>
