<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "db_bahan_baku";

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die(json_encode(["status" => "error", "message" => "Koneksi ke database gagal."]));
}
?>
