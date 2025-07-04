<?php
header("Content-Type: application/json");
require_once("../config/database.php");

$data = json_decode(file_get_contents("php://input"), true);

$kode = $data['kode_pengiriman'];
$tanggal = $data['tanggal_pengiriman'];
$tujuan = $data['tujuan'];
$produk = json_encode($data['produk_dikirim']); // array json

$sql = "INSERT INTO pengiriman (kode_pengiriman, tanggal_pengiriman, tujuan, produk_dikirim)
        VALUES ('$kode', '$tanggal', '$tujuan', '$produk')";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["status" => "success", "message" => "Pengiriman dicatat."]);
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
}
?>
