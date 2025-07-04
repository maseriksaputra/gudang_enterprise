<?php
header("Content-Type: application/json");
require_once "config/db.php";

$method = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? null;

if ($method === 'GET') {
    $stmt = $pdo->query("SELECT * FROM pelanggan");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

if ($method === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['nama'], $data['alamat'])) {
        http_response_code(400);
        echo json_encode(["message" => "Data pelanggan tidak lengkap"]);
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO pelanggan (nama, alamat, no_hp) VALUES (?, ?, ?)");
    $stmt->execute([$data['nama'], $data['alamat'], $data['no_hp'] ?? null]);

    echo json_encode(["message" => "Pelanggan ditambahkan"]);
    exit;
}

if ($method === 'PUT' && $id) {
    $data = json_decode(file_get_contents("php://input"), true);

    $stmt = $pdo->prepare("UPDATE pelanggan SET nama=?, alamat=?, no_hp=? WHERE id=?");
    $stmt->execute([$data['nama'], $data['alamat'], $data['no_hp'], $id]);

    echo json_encode(["message" => "Pelanggan diperbarui"]);
    exit;
}

if ($method === 'DELETE' && $id) {
    $stmt = $pdo->prepare("DELETE FROM pelanggan WHERE id=?");
    $stmt->execute([$id]);

    echo json_encode(["message" => "Pelanggan dihapus"]);
    exit;
}

http_response_code(405);
echo json_encode(["message" => "Metode tidak diizinkan"]);
