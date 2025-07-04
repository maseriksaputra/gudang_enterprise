<?php
header("Content-Type: application/json");
require_once("../config/database.php");

$result = mysqli_query($conn, "SELECT * FROM bahan_baku ORDER BY nama_bahan ASC");

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
?>
