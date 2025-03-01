<?php
include 'db_config.php';

$requestBody = file_get_contents("php://input");
$data = json_decode($requestBody, true);

$productID = $data['product_id'];
$size = $data['size'];
$color = $data['color'];

$query = "SELECT Price, PromotionPercentage FROM productdetails WHERE ProductID = ? AND Size = ? AND Color = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("iss", $productID, $size, $color);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode([
        "success" => true,
        "price" => (float) $row['Price'],
        "promotionPercentage" => (float) $row['PromotionPercentage']
    ]);
} else {
    echo json_encode(["success" => false]);
}

$stmt->close();
$conn->close();
?>
