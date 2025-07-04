<?php
header("Content-Type: application/json");
require_once("../config/database.php");

$data = json_decode(file_get_contents("php://input"), true);
$kode = $data['kode_produk'];

$sql = "DELETE FROM produk_jadi WHERE kode_produk = '$kode'";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["status" => "success", "message" => "Produk dihapus dari gudang."]);
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
}
?>
