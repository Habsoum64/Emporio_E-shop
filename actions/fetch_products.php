<?php
include("../settings/connection.php");

$sql = "SELECT 
            p.product_id, 
            c.cat_name AS category, 
            b.brand_name AS brand, 
            p.product_title, 
            p.product_price, 
            p.product_desc, 
            p.product_keywords, 
            p.product_image 
        FROM products p
        JOIN categories c ON p.product_cat = c.cat_id
        JOIN brands b ON p.product_brand = b.brand_id";

$result = $con->query($sql);

$products = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$con->close();

echo json_encode($products);
?>
