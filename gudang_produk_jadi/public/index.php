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
    case 'produk':
        if ($method === 'GET') {
            require_once("../api/get_produk.php");
        } elseif ($method === 'POST') {
            require_once("../api/tambah_produk.php");
        } else {
            http_response_code(405);
            echo json_encode(["error" => "Method tidak didukung"]);
        }
        break;

    case 'produk/keluar':
        if ($method === 'PUT') {
            require_once("../api/keluarkan_produk.php");
        } else {
            http_response_code(405);
            echo json_encode(["error" => "Method tidak didukung"]);
        }
        break;

    case 'produk/hapus':
        if ($method === 'DELETE') {
            require_once("../api/delete_produk.php");
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
