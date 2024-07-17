<?php
include("../settings/connection.php");

$sql = "SELECT brand_id, brand_name FROM brands";
$result = $con->query($sql);

$brands = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $brands[] = $row;
    }
}

$con->close();

header('Content-Type: application/json');
echo json_encode($brands);
?>
