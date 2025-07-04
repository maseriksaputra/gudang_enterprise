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
    case 'penjualan':
        if ($method === 'GET') {
            require_once("../api/get_penjualan.php");
        } elseif ($method === 'POST') {
            require_once("../api/tambah_penjualan.php");
        } else {
            http_response_code(405);
            echo json_encode(["error" => "Method tidak didukung"]);
        }
        break;

    case 'penjualan/status':
        if ($method === 'PUT') {
            require_once("../api/update_status.php");
        } else {
            http_response_code(405);
            echo json_encode(["error" => "Method tidak didukung"]);
        }
        break;

    case 'penjualan/hapus':
        if ($method === 'DELETE') {
            require_once("../api/delete_penjualan.php");
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
