<?php
header("Content-Type: application/json");
require_once "../lib/jwt.php";

$headers = getallheaders();
$authHeader = isset($headers['Authorization']) ? $headers['Authorization'] : '';

if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
    http_response_code(401);
    echo json_encode(["message" => "Token tidak ditemukan"]);
    exit;
}

$jwt = substr($authHeader, 7);
$payload = verify_jwt($jwt);

if (!$payload) {
    http_response_code(403);
    echo json_encode(["message" => "Token tidak valid"]);
    exit;
}

echo json_encode(["user" => $payload]);
?>
