<?php
include '../settings/connection.php';

session_start();

function cart_init() {
    $_SESSION['cart'] = [];
}

function add_to_cart($pid, $qty) {
    $product = [$pid, $qty];
    $_SESSION['cart'][] = $product;
}

function modify_product($pid, $cmd) {
    for ($i=0; $i < count($_SESSION['cart']); $i++) {
        if ($_SESSION['cart'][$i][0] == $pid) {
            switch ($cmd) {
                case "remove":
                    array_splice($_SESSION['cart'], $i, 1);
                    break;
                case "increase_qty":
                    $_SESSION['cart'][$i][1]++;
                    break;
                case "decrease_qty":
                    if ($_SESSION['cart'][$i][1] > 0) {
                        $_SESSION['cart'][$i][1]--;
                    }
                    break;
            }
        }
    }
}

function get_products() {
    $products = "(";

    foreach ($_SESSION['cart'] as $product) {
        $products .= strval($product[0]) . ",";
    }

    $products .= ")";

    global $conn;
    $sql = "SELECT * FROM products WHERE product_id in ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $products);
    
    $stmt->execute();
    $result = $stmt->get_result();
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode($products);
}

function get_qtys() {
    $qtys = [];

    foreach($_SESSION['cart'] as $product) {
        $qtys[] = $product[1];
    }

    echo json_encode($qtys);
}

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'cart_init':
            cart_init();
            break;
        case 'modify_product':
            modify_product($_POST['pid'], $_POST['cmd']);
            break;
        case 'add_to_cart':
            add_to_cart($_POST['pid'], $_POST['qty']);
            break;
        case 'get_products':
            get_products();
            break;
        case 'get_qtys':
            get_qtys();
            break;
    }
}

$conn->close();