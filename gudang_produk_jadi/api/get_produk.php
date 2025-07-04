<?php
header("Content-Type: application/json");
require_once("../config/database.php");

$sql = "SELECT * FROM produk_jadi ORDER BY tanggal_masuk DESC";
$result = mysqli_query($conn, $sql);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
?>
