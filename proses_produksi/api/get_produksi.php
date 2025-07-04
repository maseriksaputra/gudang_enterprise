<?php
header("Content-Type: application/json");
require_once("../config/database.php");

$query = "SELECT * FROM proses_produksi ORDER BY tanggal_produksi DESC";
$result = mysqli_query($conn, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
?>
