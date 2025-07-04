<?php
header("Content-Type: application/json");
require_once("../config/database.php");

$data = json_decode(file_get_contents("php://input"), true);
$kode = $data['kode_bahan'];

$sql = "DELETE FROM bahan_baku WHERE kode_bahan = '$kode'";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["status" => "success", "message" => "Bahan dihapus."]);
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
}
?>
