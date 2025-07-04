<?php
header("Content-Type: application/json");
require_once "config/db.php";

$method = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? null;

if ($method === 'GET') {
    $stmt = $pdo->query("SELECT p.id, p.tanggal, pl.nama AS pelanggan, p.produk, p.jumlah, p.total
                         FROM penjualan p
                         JOIN pelanggan pl ON p.pelanggan_id = pl.id");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

if ($method === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['tanggal'], $data['pelanggan_id'], $data['produk'], $data['jumlah'], $data['total'])) {
        http_response_code(400);
        echo json_encode(["message" => "Data penjualan tidak lengkap"]);
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO penjualan (tanggal, pelanggan_id, produk, jumlah, total) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        $data['tanggal'],
        $data['pelanggan_id'],
        $data['produk'],
        $data['jumlah'],
        $data['total']
    ]);

    echo json_encode(["message" => "Transaksi penjualan ditambahkan"]);
    exit;
}

if ($method === 'PUT' && $id) {
    $data = json_decode(file_get_contents("php://input"), true);

    $stmt = $pdo->prepare("UPDATE penjualan SET tanggal=?, pelanggan_id=?, produk=?, jumlah=?, total=? WHERE id=?");
    $stmt->execute([
        $data['tanggal'],
        $data['pelanggan_id'],
        $data['produk'],
        $data['jumlah'],
        $data['total'],
        $id
    ]);

    echo json_encode(["message" => "Transaksi diperbarui"]);
    exit;
}

if ($method === 'DELETE' && $id) {
    $stmt = $pdo->prepare("DELETE FROM penjualan WHERE id=?");
    $stmt->execute([$id]);

    echo json_encode(["message" => "Transaksi dihapus"]);
    exit;
}

http_response_code(405);
echo json_encode(["message" => "Metode tidak diizinkan"]);
