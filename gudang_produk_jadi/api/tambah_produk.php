<?php
header("Content-Type: application/json");
require_once("../config/database.php");

$data = json_decode(file_get_contents("php://input"), true);

$kode = $data['kode_produk'];
$nama = $data['nama_produk'];
$jumlah = $data['jumlah'];
$tanggal = $data['tanggal_masuk'];

$sql = "INSERT INTO produk_jadi (kode_produk, nama_produk, jumlah, tanggal_masuk)
        VALUES ('$kode', '$nama', $jumlah, '$tanggal')";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["status" => "success", "message" => "Produk ditambahkan ke gudang."]);
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
}
?>
