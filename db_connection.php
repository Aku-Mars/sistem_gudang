<?php
$servername = "localhost";
$username = "operator";
$password = "password123";
$dbname = "gudang_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
?>
