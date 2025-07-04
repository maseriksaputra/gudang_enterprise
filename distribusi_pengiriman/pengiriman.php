<?php
header("Content-Type: application/json");
require_once "config/database.php";

$method = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? null;

if ($method === 'GET') {
    $stmt = $pdo->query("SELECT * FROM pengiriman");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

if ($method === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['tanggal'], $data['nama_penerima'], $data['alamat'])) {
        http_response_code(400);
        echo json_encode(["message" => "Data tidak lengkap"]);
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO pengiriman (tanggal, nama_penerima, alamat, status_pengiriman) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $data['tanggal'],
        $data['nama_penerima'],
        $data['alamat'],
        $data['status_pengiriman'] ?? 'diproses'
    ]);

    echo json_encode(["message" => "Data pengiriman ditambahkan"]);
    exit;
}

if ($method === 'PUT' && $id) {
    $data = json_decode(file_get_contents("php://input"), true);

    $stmt = $pdo->prepare("UPDATE pengiriman SET tanggal=?, nama_penerima=?, alamat=?, status_pengiriman=? WHERE id=?");
    $stmt->execute([
        $data['tanggal'],
        $data['nama_penerima'],
        $data['alamat'],
        $data['status_pengiriman'],
        $id
    ]);

    echo json_encode(["message" => "Data pengiriman diperbarui"]);
    exit;
}

if ($method === 'DELETE' && $id) {
    $stmt = $pdo->prepare("DELETE FROM pengiriman WHERE id=?");
    $stmt->execute([$id]);

    echo json_encode(["message" => "Data pengiriman dihapus"]);
    exit;
}

http_response_code(405);
echo json_encode(["message" => "Metode tidak diizinkan"]);
