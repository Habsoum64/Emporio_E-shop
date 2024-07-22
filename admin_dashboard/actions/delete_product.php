<?php
// Include database connection
require_once '../settings/connection.php';

// Check if the product ID is provided
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Validate the product ID
    if (!is_numeric($product_id)) {
        $response = array('success' => false, 'message' => 'Invalid product ID.');
    } else {
        // Prepare the SQL delete statement
        $sql = "DELETE FROM products WHERE product_id = ?";
        
        // Initialize and execute the statement
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $product_id);
            
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    $response = array('success' => true);
                } else {
                    $response = array('success' => false, 'message' => 'No rows affected. Product ID might not exist.');
                }
            } else {
                $response = array('success' => false, 'message' => 'Failed to execute statement. Error: ' . $stmt->error);
            }
            
            $stmt->close();
        } else {
            $response = array('success' => false, 'message' => 'Failed to prepare statement. Error: ' . $conn->error);
        }
    }

    // Close the database connection
    $conn->close();
} else {
    $response = array('success' => false, 'message' => 'Product ID not provided.');
}

// Return response as JSON
header('Content-Type: application/json');
echo json_encode($response);
