<?php

include "../settings/connection.php";

function fetch_user_data($uid) {
    global $conn;
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $uid);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function fetch_users() {
    global $conn;
    $sql = "SELECT * FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $users = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }
    echo json_encode($users);
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

function fetch_products() {
    global $conn;
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

    $result = $conn->query($sql);
    $products = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    
    echo json_encode($products);
}

function delete_user($uid) {
    global $conn;
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $uid);
    $stmt->execute();
    if ($stmt->error == "") {
        echo json_encode(true);
    } else {
        echo json_encode(false);
    }
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
            fetch_user_data($_POST['uid']);
            break;
        case 'fetch_users':
            fetch_users();
            break;
        case 'delete_user':
            delete_user(intval($_POST['uid']));
            break;
        case 'fetch_orders':
            fetch_orders();
            break;
        case 'update_order_status':
            update_order_status($_POST['order_id'], $_POST['status']);
            break;
        case 'fetch_products':
            fetch_products();
            break;
    }
}

$conn->close();