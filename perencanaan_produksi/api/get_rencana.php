<?php
header("Content-Type: application/json");
require_once("../config/database.php");

$result = mysqli_query($conn, "SELECT * FROM rencana_produksi ORDER BY tanggal_rencana DESC");

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
?>
