<?php
header("Content-Type: application/json");
require_once("../config/database.php");

$data = json_decode(file_get_contents("php://input"), true);

$kode = $data['kode_bahan'];
$nama = $data['nama_bahan'];
$satuan = $data['satuan'];
$stok = $data['stok'];

$query = "INSERT INTO bahan_baku (kode_bahan, nama_bahan, satuan, stok)
          VALUES ('$kode', '$nama', '$satuan', $stok)";

if (mysqli_query($conn, $query)) {
    echo json_encode(["status" => "success", "message" => "Bahan baku ditambahkan."]);
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
}
?>
