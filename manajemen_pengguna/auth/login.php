<?php
header("Content-Type: application/json");
require_once "../config/db.php";
require_once "../lib/jwt.php";

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->username) || !isset($data->password)) {
    http_response_code(400);
    echo json_encode(["message" => "Username dan password wajib diisi"]);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$data->username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($data->password, $user['password'])) {
    http_response_code(401);
    echo json_encode(["message" => "Login gagal"]);
    exit;
}

// Hanya izinkan role admin
if ($user['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(["message" => "Hanya admin yang diizinkan"]);
    exit;
}

$token = generate_jwt(["id" => $user['id'], "username" => $user['username'], "role" => $user['role']]);

echo json_encode(["message" => "Login berhasil", "token" => $token]);
?>
