<?php
// Include database connection
require_once '../settings/connection.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize input
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $product_cat = isset($_POST['product_cat']) ? intval($_POST['product_cat']) : 0;
    $product_brand = isset($_POST['product_brand']) ? intval($_POST['product_brand']) : 0;
    $product_title = isset($_POST['product_title']) ? trim($_POST['product_title']) : '';
    $product_price = isset($_POST['product_price']) ? floatval($_POST['product_price']) : 0.0;
    $product_desc = isset($_POST['product_desc']) ? trim($_POST['product_desc']) : '';
    $product_keywords = isset($_POST['product_keywords']) ? trim($_POST['product_keywords']) : '';
    
    // Check if the product ID is valid
    if ($product_id > 0) {
        // Prepare the SQL update statement
        $sql = "UPDATE products SET product_cat = ?, product_brand = ?, product_title = ?, product_price = ?, product_desc = ?, product_keywords = ? WHERE product_id = ?";
        
        // Initialize and execute the statement
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("iisdssi", $product_cat, $product_brand, $product_title, $product_price, $product_desc, $product_keywords, $product_id);
            
            if ($stmt->execute()) {
                $response = array('success' => true);
            } else {
                $response = array('success' => false, 'message' => 'Failed to execute statement. Error: ' . $stmt->error);
            }
            
            $stmt->close();
        } else {
            $response = array('success' => false, 'message' => 'Failed to prepare statement. Error: ' . $conn->error);
        }
    } else {
        $response = array('success' => false, 'message' => 'Invalid product ID.');
    }

    // Close the database connection
    $conn->close();
} else {
    $response = array('success' => false, 'message' => 'Invalid request method.');
}

// Return response as JSON
header('Content-Type: application/json');
echo json_encode($response);

