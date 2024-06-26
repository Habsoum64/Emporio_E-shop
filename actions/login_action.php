<?php
// Include session.php
include '../settings/session.php';
// Include connection.php
include '../settings/connection.php';

// Redirect to homepage if already logged-in
redirect_if_logged_in();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $customer_email = $_POST['email'];
    $customer_pass = $_POST['password'];

    // Initialize an array to store validation errors
    $errors = [];

    // Validate inputs (you can add validation logic here if needed)

    // Check if email exists in the database
    $sql = "SELECT * FROM customer WHERE customer_email = '$customer_email'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        // Verify the password
        if (password_verify($customer_pass, $row['customer_pass'])) {
            // Start the session
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_role'] = $row['user_role'];
            $_SESSION['customer_name'] = $row['customer_name'];

            // Redirect to the user dashboard
            echo '<script>
            alert("Login successful");
            window.location = "../index.html";
            </script>';
            exit();
        } else {
            $errors[] = "Invalid password.";
        }
    } else {
        $errors[] = "No account found with that email.";
    }

    // If there are errors, display them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo '<script>alert("' . $error . '");</script>';
        }
    }

    // Close database connection
    mysqli_close($con);
}
?>

