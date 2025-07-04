<?php
header("Content-Type: application/json");
require_once("../config/modul_api.php");

$response = file_get_contents($API_ENDPOINTS["distribusi"]);
$data = json_decode($response, true);

$totalPengiriman = count($data);
$selesai = 0;

foreach ($data as $row) {
    if (strtolower($row["status_pengiriman"] ?? '') === "selesai") {
        $selesai++;
    }
}

echo json_encode([
    "total_pengiriman" => $totalPengiriman,
    "selesai" => $selesai,
    "progres" => $totalPengiriman > 0 ? round($selesai / $totalPengiriman * 100, 2) . "%" : "0%"
]);
