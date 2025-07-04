<?php
header("Content-Type: application/json");
require_once("../config/database.php");

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'];
$status = $data['status'];

$query = "UPDATE proses_produksi SET status='$status' WHERE id=$id";

if (mysqli_query($conn, $query)) {
    echo json_encode(["status" => "success", "message" => "Status diperbarui."]);
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
}
?>
