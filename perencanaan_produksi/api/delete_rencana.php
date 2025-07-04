<?php
header("Content-Type: application/json");
require_once("../config/database.php");

$input = json_decode(file_get_contents("php://input"), true);
$id = $input['id'];

$sql = "DELETE FROM rencana_produksi WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    echo json_encode(["status" => "success", "message" => "Rencana dihapus."]);
} else {
    echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
}
?>
