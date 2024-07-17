<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo '<script>
        alert("Session not found. Please log in.");
        window.location.href = "../user_dashboard/signin.php";
        </script>';
    exit();
}

// Optional: Check for user role if needed
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] != 'admin') {
    echo '<script>
        alert("Access denied. Admins only.");
        window.location.href = "../user_dashboard/index.php";
        </script>';
    exit();
}
?>
