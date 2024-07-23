<?php
include("../settings/connection.php");

$sql = "SELECT brand_id, brand_name FROM brands";
$result = $conn->query($sql);

$brands = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $brands[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($brands);
