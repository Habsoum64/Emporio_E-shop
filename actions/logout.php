<?php
// Include session.php for session management functions
include("../settings/session.php");

// Call logout_user() function to handle logout process
logout_user();

// Logout user function definition
function logout_user() {
    // Unset all session variables
    $_SESSION = array();
    
    // Destroy the session
    session_destroy();
    
    // Redirect to signup page
    header("Location: ../user_dashboard/signup.html");
    exit();
}
?>
