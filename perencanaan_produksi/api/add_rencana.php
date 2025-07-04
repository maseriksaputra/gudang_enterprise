<?php
header("Content-Type: application/json");
require_once("../config/database.php");

$input = json_decode(file_get_contents("php://input"), true);

$kode = $input['kode_rencana'];
$produk = $input['produk'];
$jumlah = $input['jumlah'];
$tanggal = $input['tanggal_rencana'];

$sql = "INSERT INTO rencana_produksi (kode_rencana, produk, jumlah, tanggal_rencana)
        VALUES ('$kode', '$produk', $jumlah, '$tanggal')";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["status" => "success", "message" => "Rencana ditambahkan."]);
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
}
?>
