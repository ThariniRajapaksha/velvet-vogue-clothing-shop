<?php
session_start();
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_SESSION['email'];
    $firstName = $conn->real_escape_string($_POST['firstName']);
    $lastName = $conn->real_escape_string($_POST['lastName']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $dob = $conn->real_escape_string($_POST['dob']);

    // Handle profile image upload
    $profileImage = null;
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $profileImage = $uploadDir . basename($_FILES['profileImage']['name']);
        if (!move_uploaded_file($_FILES['profileImage']['tmp_name'], $profileImage)) {
            die("Error uploading profile image.");
        }
    }

    // Retrieve current image if no new image is uploaded
    if (!$profileImage) {
        $stmt = $conn->prepare("SELECT profile_image FROM customer_details WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($currentImage);
        $stmt->fetch();
        $stmt->close();
        $profileImage = $currentImage;
    }

    // Update or insert customer details
    $stmt = $conn->prepare("REPLACE INTO customer_details (email, first_name, last_name, phone, address, gender, dob, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $email, $firstName, $lastName, $phone, $address, $gender, $dob, $profileImage);

    if ($stmt->execute()) {
        header("Location: Customer Details.php?success=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
