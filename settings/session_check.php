<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: ../user_dashboard/signin.php");
    exit();
}
?>
