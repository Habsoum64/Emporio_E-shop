<?php
include("../settings/connection.php");

$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id > 0) {
    $sql = "SELECT product_id, product_cat, product_brand, product_title, product_price, product_desc, product_keywords 
            FROM products 
            WHERE product_id = ?";
    
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            echo json_encode($product);
        } else {
            echo json_encode(['error' => 'Product not found']);
        }
        
        $stmt->close();
    } else {
        echo json_encode(['error' => 'Failed to prepare statement']);
    }
} else {
    echo json_encode(['error' => 'Invalid product ID']);
}

$con->close();
?>
