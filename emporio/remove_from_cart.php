<?php
session_start();

include 'settings/connection.php';

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $product_id = $_GET['id'];

    // Remove the item from the cart in the session variable
    if(isset($_SESSION['cart']) && isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
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
