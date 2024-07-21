<?php
session_start();

function check_login() {
    if (!isset($_SESSION['user_id'])) {
        return false;
    } else {
        return true;
    }
}

function redirect_to_login() {
    if (!check_login()) {
        header("Location: ../login/login.html");
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
    $utype = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : null;
    echo json_encode($utype);
}
