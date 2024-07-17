<?php
include("../settings/connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $product_cat = isset($_POST['product_cat']) ? intval($_POST['product_cat']) : 0;
    $product_brand = isset($_POST['product_brand']) ? intval($_POST['product_brand']) : 0;
    $product_title = isset($_POST['product_title']) ? trim($_POST['product_title']) : '';
    $product_price = isset($_POST['product_price']) ? floatval($_POST['product_price']) : 0.0;
    $product_desc = isset($_POST['product_desc']) ? trim($_POST['product_desc']) : '';
    $product_keywords = isset($_POST['product_keywords']) ? trim($_POST['product_keywords']) : '';
    $product_image = isset($_FILES['product_image']) ? $_FILES['product_image'] : null;

    if ($product_id > 0) {
        $sql = "UPDATE products SET product_cat = ?, product_brand = ?, product_title = ?, product_price = ?, product_desc = ?, product_keywords = ?";
        
        if ($product_image && $product_image['tmp_name']) {
            $image_name = basename($product_image['name']);
            $target_file = "../uploads/" . $image_name;
            if (move_uploaded_file($product_image['tmp_name'], $target_file)) {
                $sql .= ", product_image = ?";
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to upload image']);
                exit();
            }
        }
        
        $sql .= " WHERE product_id = ?";
        
        if ($stmt = $con->prepare($sql)) {
            if ($product_image && $product_image['tmp_name']) {
                $stmt->bind_param("iisdsssi", $product_cat, $product_brand, $product_title, $product_price, $product_desc, $product_keywords, $image_name, $product_id);
            } else {
                $stmt->bind_param("iisdssi", $product_cat, $product_brand, $product_title, $product_price, $product_desc, $product_keywords, $product_id);
            }
            
            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update product.']);
            }
            
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to prepare statement.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid product ID.']);
    }

    $con->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
