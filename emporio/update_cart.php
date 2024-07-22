<?php

session_start();

include 'settings/connection.php';

if(isset($_POST['product_id'], $_POST['quantity']) && !empty($_POST['product_id']) && !empty($_POST['quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Update the quantity in the cart in the session variable
    if(isset($_SESSION['cart']) && isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] = $quantity;
    }

    // Redirect back to view_cart.php
    header('Location: view_cart.php');
    exit();
} else {
    // Invalid request, redirect to view_cart.php
    header('Location: view_cart.php');
    exit();
}

?>
