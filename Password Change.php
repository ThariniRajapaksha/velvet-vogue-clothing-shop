<?php
session_start();
require 'db_config.php'; 

if (!isset($_SESSION['email'])) {
    die("User not logged in. Please log in again.");
}

$email = $_SESSION['email']; 
$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    $stmt = $conn->prepare("SELECT Password FROM customerregister WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);
    
    if ($stmt->fetch()) { 
        if (password_verify($currentPassword, $hashedPassword)) {
            if ($newPassword === $confirmPassword) {
                $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $stmt->close();

                $updateStmt = $conn->prepare("UPDATE customerregister SET Password = ? WHERE Email = ?");
                $updateStmt->bind_param("ss", $newHashedPassword, $email);
                if ($updateStmt->execute()) {
                    $message = "Password successfully updated!";
                } else {
                    $message = "Error updating password. Please try again.";
                }
                $updateStmt->close();
            } else {
                $message = "New password and confirmation do not match.";
            }
        } else {
            $message = "Current password is incorrect.";
        }
    } else {
        $message = "User not found in the database.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="Password Change.css">

    <!-- Font Awesome CDN link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <a href="Home Page.php">
                    <img src="Images/Logo Velvet Vogue.png" alt="Logo">
                </a>
            </div> 
            <nav>
                <a href="Home Page.php">Back to Home</a> | <a href="logout.php">Log Out</a>
            </nav>
        </div>
    </header>

    <main class="container">
        <!-- Left Section: Image -->
        <div class="image-section">
            <img src="Images/Security.png" alt="Change Password Illustration">
        </div>

        <!-- Right Section: Form -->
        <div class="form-section">
            <h1>Change Password</h1>
            <form method="POST">
                <label for="current_password"><i class="fa-solid fa-key"></i> Current Password:</label>
                <input type="password" id="current_password" name="current_password" required>
                
                <label for="new_password"><i class="fa-solid fa-lock"></i> New Password:</label>
                <input type="password" id="new_password" name="new_password" required>
                
                <label for="confirm_password"><i class="fa-solid fa-unlock-keyhole"></i> Confirm New Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                
                <button type="submit">Submit</button>
            </form>
            <p class="<?= $message === 'Password successfully updated!' ? 'success' : 'error' ?>">
                <?= $message ?>
            </p>
        </div>
    </main>
</body>
</html>
