<?php
header("Content-Type: application/json");
require_once("../config/database.php");

$data = json_decode(file_get_contents("php://input"), true);

$kode = $data['kode_transaksi'];
$nama = $data['nama_pelanggan'];
$tanggal = $data['tanggal_transaksi'];
$produk = json_encode($data['produk_dibeli']); // format JSON array
$total = $data['total_harga'];

$sql = "INSERT INTO penjualan (kode_transaksi, nama_pelanggan, tanggal_transaksi, produk_dibeli, total_harga)
        VALUES ('$kode', '$nama', '$tanggal', '$produk', $total)";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["status" => "success", "message" => "Data penjualan ditambahkan."]);
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
}
?>
