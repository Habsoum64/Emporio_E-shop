<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("../settings/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_cat = $_POST['product_cat'];
    $product_brand = $_POST['product_brand'];
    $product_title = $_POST['product_title'];
    $product_price = $_POST['product_price'];
    $product_desc = $_POST['product_desc'];
    $product_keywords = $_POST['product_keywords'];
    $product_image = $_FILES['product_image']['name'];

    // Image upload path
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($product_image);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["product_image"]["tmp_name"]);
    if ($check === false) {
        die("File is not an image.");
    }

    // Check file size (limit to 5MB)
    if ($_FILES["product_image"]["size"] > 5000000) {
        die("Sorry, your file is too large.");
    }

    // Allow certain file formats
    $allowed_formats = array("jpg", "png", "jpeg", "gif");
    if (!in_array($imageFileType, $allowed_formats)) {
        die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
    }

    // Upload image
    if (!move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
        die("Sorry, there was an error uploading your file. Error code: " . $_FILES['product_image']['error']);
    }

    // Insert product into database
    $sql = "INSERT INTO products (product_cat, product_brand, product_title, product_price, product_desc, product_keywords, product_image) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("issdsss", $product_cat, $product_brand, $product_title, $product_price, $product_desc, $product_keywords, $product_image);

    if ($stmt->execute()) {
        echo "New product added successfully!";
    } else {
        echo "Error executing statement: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
