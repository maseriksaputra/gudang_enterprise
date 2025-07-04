<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$url = $_GET['url'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];

switch ($url) {
    case 'login':
        if ($method === 'POST') {
            require_once("../api/login.php");
        }
        break;
    case 'me':
        if ($method === 'GET') {
            require_once("../api/get_user.php");
        }
        break;
    default:
        http_response_code(404);
        echo json_encode(["error" => "Endpoint tidak ditemukan"]);
}
?>
