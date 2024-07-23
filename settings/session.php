<?php
session_start();

function check_login() {
    if (!isset($_SESSION['user_id'])) {
        echo 'false';
    } else {
        echo 'true';
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
    $utype = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;
    echo $utype;
}


function get_session_vars() {
    $session_vars = ['user_id' => $_SESSION['user_id'], 'user_role' => $_SESSION['user_role'], 'user_email' => $_SESSION['user_email']];
    json_encode($session_vars);
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