<?php
header("Content-Type: application/json");
require_once("../config/database.php");

$data = json_decode(file_get_contents("php://input"), true);

$kode = $data['kode_produk'];
$jumlah = $data['jumlah'];

$sql = "UPDATE produk_jadi 
        SET jumlah = jumlah - $jumlah 
        WHERE kode_produk = '$kode' AND jumlah >= $jumlah";

if (mysqli_query($conn, $sql)) {
    if (mysqli_affected_rows($conn) > 0) {
        // Jika jumlah = 0, ubah status
        mysqli_query($conn, "UPDATE produk_jadi SET status='Keluar' WHERE kode_produk = '$kode' AND jumlah = 0");
        echo json_encode(["status" => "success", "message" => "Produk berhasil dikurangi."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Stok tidak mencukupi atau kode tidak ditemukan."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
}
?>
