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
    $admin_code = isset($_POST['admin_code']) ? $_POST['admin_code'] : '';

    $user_role = 'customer'; // Default role
    if (!empty($admin_code)) {
        // Check if the admin code is valid
        $sql = "SELECT * FROM admin_codes WHERE code = ? ORDER BY generated_at DESC LIMIT 1";
        $stmt = mysqli_prepare($con, $sql);
        if (!$stmt) {
            die("MySQL prepare statement failed: " . mysqli_error($con));
        }
        mysqli_stmt_bind_param($stmt, 's', $admin_code);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 0) {
            echo '<script>
                alert("Invalid admin code.");
                window.location.href = "../user_dashboard/signup.php";
                </script>';
            exit();
        }

        mysqli_stmt_close($stmt);
        $user_role = 'admin'; // Assign admin role if the code is valid
    }

    $sql = "INSERT INTO users (first_name, last_name, email, password, user_role) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    if (!$stmt) {
        die("MySQL prepare statement failed: " . mysqli_error($con));
    }
    mysqli_stmt_bind_param($stmt, 'sssss', $first_name, $last_name, $email, $password, $user_role);

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>
            alert("Registration successful. Please log in.");
            window.location.href = "../user_dashboard/signin.php";
            </script>';
    } else {
        echo '<script>
            alert("Registration failed. Please try again.");
            </script>';
        echo "MySQL Error: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
} else {
    echo "Form not submitted.";
}
?>
