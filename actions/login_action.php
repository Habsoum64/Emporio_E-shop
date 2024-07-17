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

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_role'] = $row['user_role'];
            $_SESSION['user_email'] = $row['email'];

            if ($row['user_role'] == 'admin') {
                echo '<script>
                    alert("Login successful. Redirecting to admin dashboard.");
                    window.location.href = "../admin_dashboard/index.html";
                    </script>';
            } else {
                echo '<script>
                    alert("Login successful. Redirecting to user dashboard.");
                    window.location.href = "../user_dashboard/index.html";
                    </script>';
            }
        } else {
            echo '<script>
                alert("Invalid password. Please try again.");
                window.location.href = "../user_dashboard/signin.html";
                </script>';
        }
    } else {
        echo '<script>
            alert("No user found with that email. Please try again.");
            window.location.href = "../user_dashboard/signin.html";
            </script>';
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
} else {
    echo "Form not submitted.";
}
?>
