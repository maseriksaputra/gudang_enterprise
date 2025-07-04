<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$url = $_GET['url'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];

switch ($url) {
    // GET & POST rencana produksi
    case 'rencana':
        if ($method === 'GET') {
            require_once("../api/get_rencana.php");
        } elseif ($method === 'POST') {
            require_once("../api/add_rencana.php");
        } else {
            http_response_code(405);
            echo json_encode(["error" => "Method tidak didukung"]);
        }
        break;

    // Update status rencana (ex: Menunggu → Sedang Diproduksi)
    case 'rencana/update':
        if ($method === 'PUT') {
            require_once("../api/update_rencana.php");
        } else {
            http_response_code(405);
            echo json_encode(["error" => "Method tidak didukung"]);
        }
        break;

    // Hapus rencana
    case 'rencana/hapus':
        if ($method === 'DELETE') {
            require_once("../api/delete_rencana.php");
        } else {
            http_response_code(405);
            echo json_encode(["error" => "Method tidak didukung"]);
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(["error" => "Endpoint tidak ditemukan"]);
        break;
}
