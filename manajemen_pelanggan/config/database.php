<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "db_penjualan";

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
    die(json_encode(["status" => "error", "message" => "Koneksi database gagal."]));
}
?>
