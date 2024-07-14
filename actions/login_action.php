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
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Fetch user data from the database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($con, $sql);
    if (!$stmt) {
        echo '<script>alert("Database error: ' . mysqli_error($con) . '"); window.history.back();</script>';
        exit();
    }
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Start the session
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['user_role'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];

            // Redirect based on user role
            if ($user['user_role'] == 'admin') {
                echo '<script>window.location = "../admin_dashboard/index.html";</script>';
            } else {
                echo '<script>window.location = "../user_dashboard/index.html";</script>';
            }
            exit();
        } else {
            echo '<script>alert("Invalid password."); window.history.back();</script>';
            exit();
        }
    } else {
        echo '<script>alert("No account found with that email."); window.history.back();</script>';
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
