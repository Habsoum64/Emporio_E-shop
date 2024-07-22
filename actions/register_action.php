<?php
include '../settings/connection.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $user_role = 'customer';
    

    $sql = "INSERT INTO users (first_name, last_name, email, password, user_role) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        die("MySQL prepare statement failed: " . mysqli_error($con));
    }
    mysqli_stmt_bind_param($stmt, 'sssss', $first_name, $last_name, $email, $password, $user_role);

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>
            alert("Registration successful. Please log in.");
            window.location.href = "../login/signin.html";
            </script>';
    } else {
        echo '<script>
            alert("Registration failed. Please try again.");
            </script>';
        echo "MySQL Error: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo "Form not submitted.";
}

