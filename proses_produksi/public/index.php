<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Ambil URL
$url = $_GET['url'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];

switch ($url) {

    // GET semua proses produksi
    case 'produksi':
        if ($method === 'GET') {
            require_once("../api/get_produksi.php");
        } else if ($method === 'POST') {
            require_once("../api/add_produksi.php");
        } else {
            http_response_code(405);
            echo json_encode(["error" => "Method tidak didukung"]);
        }
        break;

    // Update status produksi
    case 'produksi/status':
        if ($method === 'PUT') {
            require_once("../api/update_status.php");
        } else {
            http_response_code(405);
            echo json_encode(["error" => "Method tidak didukung"]);
        }
        break;

    // Hapus data produksi
    case 'produksi/hapus':
        if ($method === 'DELETE') {
            require_once("../api/delete_produksi.php");
        } else {
            http_response_code(405);
            echo json_encode(["error" => "Method tidak didukung"]);
        }
        break;

    // Route default jika tidak cocok
    default:
        http_response_code(404);
        echo json_encode(["error" => "Endpoint tidak ditemukan"]);
        break;
}
