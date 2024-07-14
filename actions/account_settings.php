<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Content-Type: application/json");
    echo json_encode(["error" => "User not logged in"]);
    exit();
}

include '../settings/connection.php';

// Fetch user data from users table
$user_id = $_SESSION['user_id'];
$user_role = $_SESSION['user_role'];

$sql = "SELECT * FROM users WHERE id = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, 'i', $user_id);
mysqli_stmt_execute($stmt);
$user_result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($user_result);

$customer = null;
if ($user_role == 'customer') {
    // Fetch additional customer data
    $sql = "SELECT * FROM customer WHERE email = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 's', $user['email']);
    mysqli_stmt_execute($stmt);
    $customer_result = mysqli_stmt_get_result($stmt);
    $customer = mysqli_fetch_assoc($customer_result);
}

mysqli_stmt_close($stmt);
mysqli_close($con);

header("Content-Type: application/json");
echo json_encode([
    "user" => $user,
    "customer" => $customer
]);
exit();
?>
