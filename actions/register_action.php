<?php
// Include session.php
include '../settings/session.php';
// Include connection.php
include '../settings/connection.php';

// Redirect to homepage if already logged-in
redirect_if_logged_in();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $customer_name = $_POST['username'];
    $customer_email = $_POST['email'];
    $customer_pass = $_POST['password'];
    $user_role = 'user'; // Assign a default user role, you can modify this as needed

    // Initialize an array to store validation errors
    $errors = [];

    // Validate inputs (you can add validation logic here if needed)

    // Hash the password
    $hashed_password = password_hash($customer_pass, PASSWORD_DEFAULT);

    // Insert data into the database
    $sql = "INSERT INTO customer (customer_name, customer_email, customer_pass, user_role)
            VALUES ('$customer_name', '$customer_email', '$hashed_password', '$user_role')";

    if (mysqli_query($con, $sql)) {
        echo '<script>
        alert ("Registration successful");
        window.location = "../user_dashboard/signin.html";
        </script>';
    
        exit();
    } else {
        // Insert failed
        // Handle the error as needed
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    // Close database connection
    mysqli_close($con);
}
?>
