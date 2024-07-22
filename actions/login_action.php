<?php
include '../settings/connection.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($con, $sql);
    if (!$stmt) {
        die("MySQL prepare statement failed: " . mysqli_error($con));
    }
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            // Password is correct, start the session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['user_role'];
            $_SESSION['user_email'] = $user['email'];

            // Debugging output
            echo "Session variables set: <br>";
            echo "User ID: " . $_SESSION['user_id'] . "<br>";
            echo "User Role: " . $_SESSION['user_role'] . "<br>";
            echo "User Email: " . $_SESSION['user_email'] . "<br>";

            // Redirect based on user role
            if ($user['user_role'] == 'admin') {
                header("Location: ../admin_dashboard/index.php");
            } else {
                header("Location: ../user_dashboard/index.php");
            }
            exit();
        } else {
            echo '<script>
                alert("Incorrect password.");
                window.location.href = "../user_dashboard/signin.php";
                </script>';
        }
    } else {
        echo '<script>
            alert("No user found with this email.");
            window.location.href = "../user_dashboard/signin.php";
            </script>';
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
} else {
    echo "Form not submitted.";
}
