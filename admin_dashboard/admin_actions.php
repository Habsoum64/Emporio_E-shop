<?php

include "../settings/connection.php";

function fetch_user_data($user_id) {
    global $conn;
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
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

function delete_user($user_id) {
    global $conn;
    $sql = "DELETE FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
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

function update_order_status($order_id, $status) {
    global $conn;
    $sql = "UPDATE orders SET order_status = ? WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $order_id);
    $stmt->execute();
}

function fetch_products() {
    global $conn;
    $sql = "SELECT * FROM products";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode($products);
}

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'fetch_user_data':
            fetch_user_data($_POST['user_id']);
            break;
        case 'fetch_users':
            fetch_users();
            break;
        case 'delete_user':
            delete_user($_POST['user_id']);
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

?>
