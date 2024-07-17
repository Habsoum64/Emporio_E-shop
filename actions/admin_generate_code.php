<?php
session_start();

// Check if the user is an admin
if ($_SESSION['user_role'] !== 'admin') {
    echo "Access denied.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../settings/connection.php';

    // Generate a new secure admin code
    $admin_code = bin2hex(random_bytes(16)); // Generates a 32-character random code

    // Insert the new admin code into the database
    $sql = "INSERT INTO admin_codes (admin_code) VALUES (?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('s', $admin_code);

    if ($stmt->execute()) {
        echo "New admin code generated and stored successfully: $admin_code";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Admin Code</title>
</head>
<body>
    <h1>Generate Admin Code</h1>
    <form method="post" action="admin_generate_code.php">
        <button type="submit">Generate New Admin Code</button>
    </form>
</body>
</html>
