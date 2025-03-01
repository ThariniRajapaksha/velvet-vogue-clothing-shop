<?php
include 'db_config.php';


$sql = "
    SELECT 
        product.ProductName, 
        product.Image, 
        productdetails.Price
    FROM 
        product 
    INNER JOIN 
        productdetails 
    ON 
        product.ProductID = productdetails.ProductID
    ORDER BY 
        product.ProductID DESC  -- Order by ProductID in descending order (newer products first)
    LIMIT 12                         -- Limit the result to the last 12 products
";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $products = array();
    
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    
    echo json_encode($products);
} else {
    echo json_encode([]);  
}

$conn->close();
?>
