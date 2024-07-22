<?php
session_start();

function check_login() {
    if (!isset($_SESSION['user_id'])) {
        json_encode('false');
    } else {
        json_encode('true');
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

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'check_login':
            check_login();
            break;
        case 'redirect_to_login':
            redirect_to_login();
            break;
        case 'redirect_if_logged_in':
            redirect_if_logged_in();
            break;
        case 'get_user_type':
            get_user_type();
            break;
    }
}