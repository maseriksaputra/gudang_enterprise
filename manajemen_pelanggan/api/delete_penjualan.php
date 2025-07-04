<?php
header("Content-Type: application/json");
require_once("../config/database.php");

$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];

$sql = "DELETE FROM penjualan WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["status" => "success", "message" => "Data transaksi dihapus."]);
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
}
?>
