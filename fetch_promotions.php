<?php
include 'db_config.php'; 

$sql = "
    SELECT 
        product.ProductID, 
        product.ProductName, 
        product.Image, 
        productdetails.Price AS OriginalPrice, 
        productdetails.PromotionPercentage, 
        productdetails.Price - (productdetails.Price * productdetails.PromotionPercentage / 100) AS DiscountedPrice
    FROM 
        product
    INNER JOIN 
        productdetails 
    ON 
        product.ProductID = productdetails.ProductID
    WHERE 
        product.IsPromotion = 1 AND productdetails.PromotionPercentage > 0
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $promotions = array();
    while ($row = $result->fetch_assoc()) {
        $row['DiscountedPrice'] = number_format($row['DiscountedPrice'], 2);
        $promotions[] = $row;
    }

    echo json_encode($promotions);
} else {
    echo json_encode([]);
}

$conn->close();
?>
