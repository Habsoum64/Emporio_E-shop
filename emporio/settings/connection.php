<?php

$SERVER = "localhost";
$USERNAME = "root";
$PASSWD = "";
$DATABASE = "emporio_db";
$port = 3307;




$conn = new mysqli($SERVER, $USERNAME, $PASSWD, $DATABASE, $port) or die ("Could not connect database");

// Check if connection was successful 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


