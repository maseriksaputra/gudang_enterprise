<?php
header("Content-Type: application/json");
require_once("../config/database.php");

$data = json_decode(file_get_contents("php://input"), true);

$kode_produksi = $data['kode_produksi'];
$kode_rencana = $data['kode_rencana'];
$tanggal = $data['tanggal_produksi'];
$bahan_terpakai = $data['bahan_terpakai']; // string JSON bahan
$hasil = $data['hasil_produk'];
$jumlah = $data['jumlah'];

$query = "INSERT INTO proses_produksi 
(kode_produksi, kode_rencana, tanggal_produksi, bahan_terpakai, hasil_produk, jumlah) 
VALUES 
('$kode_produksi', '$kode_rencana', '$tanggal', '$bahan_terpakai', '$hasil', $jumlah)";

if (mysqli_query($conn, $query)) {
    echo json_encode(["status" => "success", "message" => "Data produksi ditambahkan."]);
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
}
?>
