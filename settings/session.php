<?php
session_start();

function check_login() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}

function redirect_if_logged_in() {
    if (isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }
}

function get_user_type() {
    return isset($_SESSION['user_type']) ? $_SESSION['user_type'] : null;
}

function logout_user() {
    // Unset all session variables
    $_SESSION = array();
    
    // Destroy the session
    session_destroy();
    
    // Redirect to login page
    header("Location: ../user_dashboard/signin.html");
    exit();
}
?>