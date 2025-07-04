<?php
header("Content-Type: application/json");
require_once("../config/database.php");

$sql = "SELECT * FROM penjualan ORDER BY tanggal_transaksi DESC";
$result = mysqli_query($conn, $sql);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $row["produk_dibeli"] = json_decode($row["produk_dibeli"], true);
    $data[] = $row;
}

echo json_encode($data);
?>
