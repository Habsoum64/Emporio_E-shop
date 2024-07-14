<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "test_register_action.php script reached.<br>";

// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "POST request detected.<br>";

    // Retrieve form data
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $user_role = isset($_POST['user_role']) ? $_POST['user_role'] : '';

    // Debugging output for form data
    echo "Form data received:<br>";
    echo "First Name: $first_name<br>";
    echo "Last Name: $last_name<br>";
    echo "Email: $email<br>";
    echo "Password: $password<br>";
    echo "User Role: $user_role<br>";

    // Simulate success
    echo '<script>
    alert("Form data successfully received and processed.");
    window.location.href = "../user_dashboard/signin.html";
    </script>';
} else {
    echo "Form not submitted.<br>";
}
?>
