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

function fetch_orders($user_id) {
    global $conn;
    $sql = "SELECT * FROM orders WHERE id = $user_id";
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
    }
}

$conn->close();
