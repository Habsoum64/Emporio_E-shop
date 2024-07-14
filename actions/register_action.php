<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include connection.php
if (file_exists('../settings/connection.php')) {
    include '../settings/connection.php';
} else {
    echo '<script>alert("Error: connection.php not found."); window.history.back();</script>';
    exit();
}

// Check database connection
if (!isset($con) || !$con) {
    echo '<script>alert("Database connection failed: ' . mysqli_connect_error() . '"); window.history.back();</script>';
    exit();
}

// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $user_role = isset($_POST['user_role']) ? $_POST['user_role'] : '';

    // Validate inputs
    if (empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($user_role)) {
        echo '<script>alert("All fields are required."); window.history.back();</script>';
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Invalid email format."); window.history.back();</script>';
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the database
    $sql = "INSERT INTO users (first_name, last_name, email, password, user_role)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    if (!$stmt) {
        echo '<script>alert("Database error: ' . mysqli_error($con) . '"); window.history.back();</script>';
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'sssss', $first_name, $last_name, $email, $hashed_password, $user_role);
    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Registration successful"); window.location.href = "../user_dashboard/signin.html";</script>';
        exit();
    } else {
        echo '<script>alert("Error: ' . mysqli_stmt_error($stmt) . '"); window.history.back();</script>';
        exit();
    }

    // Close database connection
    mysqli_stmt_close($stmt);
    mysqli_close($con);
} else {
    echo '<script>alert("Invalid request method."); window.history.back();</script>';
    exit();
}
?>
