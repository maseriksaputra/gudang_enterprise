<?php
header("Content-Type: application/json");
require_once("../config/database.php");

$data = json_decode(file_get_contents("php://input"), true);

$kode = $data['kode_bahan'];
$jumlah = $data['jumlah'];

$sql = "UPDATE bahan_baku SET stok = stok - $jumlah WHERE kode_bahan = '$kode' AND stok >= $jumlah";

if (mysqli_query($conn, $sql)) {
    if (mysqli_affected_rows($conn) > 0) {
        echo json_encode(["status" => "success", "message" => "Stok dikurangi."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Stok tidak mencukupi atau kode tidak ditemukan."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
}
?>
