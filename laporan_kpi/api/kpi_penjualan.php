<?php
header("Content-Type: application/json");
require_once("../config/modul_api.php");

$response = file_get_contents($API_ENDPOINTS["penjualan"]);
$data = json_decode($response, true);

$totalTransaksi = count($data);
$totalPenjualan = 0;

foreach ($data as $row) {
    $totalPenjualan += $row["total_harga"] ?? 0;
}

echo json_encode([
    "total_transaksi" => $totalTransaksi,
    "total_penjualan" => $totalPenjualan
]);
