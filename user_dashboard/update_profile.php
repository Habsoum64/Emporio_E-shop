<?php
include '../settings/session_check.php';

// Include session.php
include '../settings/session.php';
// Include connection.php
include '../settings/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $date_of_birth = $_POST['date_of_birth'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $contact = $_POST['contact'];
    
    // Update the user information in the database
    $query = "UPDATE customer SET first_name='$first_name', last_name='$last_name', email='$email', 
              password='$password', date_of_birth='$date_of_birth', country='$country', city='$city', 
              contact='$contact' WHERE customer_id='your_customer_id'";
    
    if (mysqli_query($con, $query)) {
        echo "Profile updated successfully.";
    } else {
        echo "Error updating profile: " . mysqli_error($con);
    }

    mysqli_close($con);
}
?>
