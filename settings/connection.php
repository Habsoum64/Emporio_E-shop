<?php
$servername = "localhost:3308";
$username = "root";
$password = "";
$database = "emporio_db";
// Create connection
$con = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "connection success";
}
?>
