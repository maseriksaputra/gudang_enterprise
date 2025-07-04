<?php
header("Content-Type: application/json");
require_once("../config/modul_api.php");

$response = file_get_contents($API_ENDPOINTS["produksi"]);
$data = json_decode($response, true);

$totalProduksi = 0;
$produk = [];

foreach ($data as $row) {
    $totalProduksi += $row["jumlah"];
    $produk[$row["hasil_produk"]] = ($produk[$row["hasil_produk"]] ?? 0) + $row["jumlah"];
}

echo json_encode([
    "total_produksi" => $totalProduksi,
    "per_produk" => $produk
]);
