<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$url = $_GET['url'] ?? '';

switch ($url) {
    case 'kpi/produksi':
        require_once("../api/kpi_produksi.php");
        break;

    case 'kpi/penjualan':
        require_once("../api/kpi_penjualan.php");
        break;

    case 'kpi/distribusi':
        require_once("../api/kpi_distribusi.php");
        break;

    default:
        http_response_code(404);
        echo json_encode(["error" => "Endpoint tidak ditemukan"]);
        break;
}
