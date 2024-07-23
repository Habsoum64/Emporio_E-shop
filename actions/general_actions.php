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

    // Fetching the categories
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
        $sql .= "AND c.cat_id = ?";
    }
    
    $filter = strval($sort);

    if ($filter = "nothing") {
        $sql .= " ORDER BY RAND()";
    } elseif ($filter = "price high") {
        $sql .= " ORDER BY p.product_price DSC";
    } elseif ($filter = "price low") {
        $sql .= " ORDER BY p.product_price ASC";
    } elseif ($filter = "name") {
        $sql .= " ORDER BY p.product_name";
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
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = [];
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }
    echo json_encode($orders);
}

function search_product($pname) {
    global $conn;
    $sql = "SELECT * FROM products WHERE product_name LIKE '?'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $pname);
    
    $stmt->execute();
    $result = $stmt->get_result();
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode($products);
}

function update_order_status($order_id, $status) {
    global $conn;
    $sql = "UPDATE orders SET order_status = ? WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $order_id);
    $stmt->execute();
}


if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'fetch_user_data':
            fetch_user_data($_POST['user_id']);
            break;
        case 'fetch_orders':
            fetch_orders();
            break;
        case 'update_order_status':
            update_order_status($_POST['order_id'], $_POST['status']);
            break;
        case 'fetch_products':
            fetch_products($_POST['category'], $_POST['number'], $_POST['sort']);
            break;
        case 'fetch_categories':
            fetch_categories();
            break;
        case 'search_product':
            search_product($_POST['pname']);
            break;
    }
}

$conn->close();
