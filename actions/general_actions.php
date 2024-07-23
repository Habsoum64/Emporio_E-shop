<?php

include "../settings/connection.php";

function fetch_user_data($user_id) {
    global $conn;
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function fetch_categories() {
    global $conn;
    $categories = [];

    $sql = "SELECT cat_name FROM categories";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
    echo json_encode($categories);
}

function fetch_orders() {
    global $conn;
    $sql = "SELECT * FROM orders";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $orders = [];
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
    echo json_encode($orders);
}

function fetch_products($category, $number, $sort) {
    global $conn;
    $sql = "SELECT * FROM products p, categories c WHERE p.product_cat = c.cat_id";
    
    if ($category != "all") {
        $sql .= " AND c.cat_name = ?";
    }

    if ($sort == "nothing") {
        $sql .= " ORDER BY RAND()";
    } elseif ($sort == "price high") {
        $sql .= " ORDER BY p.product_price DESC";
    } elseif ($sort == "price low") {
        $sql .= " ORDER BY p.product_price ASC";
    } elseif ($sort == "name") {
        $sql .= " ORDER BY p.product_title";
    }

    $sql .= " LIMIT ?";

    $stmt = $conn->prepare($sql);
    if ($category != "all") {
        $stmt->bind_param("si", $category, $number);
    } else {
        $stmt->bind_param("i", $number);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode($products);
}

function get_product($pid) {
    global $conn;
    $sql = "SELECT 
            c.cat_name AS category, 
            b.brand_name AS brand, 
            p.product_title, 
            p.product_price, 
            p.product_desc, 
            p.product_keywords, 
            p.product_image 
            FROM products p 
            JOIN categories c ON p.product_cat = c.cat_id 
            JOIN brands b ON p.product_brand = b.brand_id 
            WHERE p.product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    echo json_encode($product);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'fetch_categories') {
        fetch_categories();
    } elseif ($action === 'fetch_orders') {
        fetch_orders();
    } elseif ($action === 'fetch_products') {
        $category = $_POST['category'];
        $number = $_POST['number'];
        $sort = $_POST['sort'];
        fetch_products($category, $number, $sort);
    } elseif ($action === 'get_product') {
        $pid = $_POST['pid'];
        get_product($pid);
    }
}
