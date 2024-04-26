<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'operator') {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $barangId = $_POST['barang_id'];

    $sql = "DELETE FROM barang WHERE id=$barangId";

    if ($conn->query($sql) === TRUE) {
        // Jika penghapusan berhasil, arahkan pengguna kembali ke halaman edit gudang
        header('Location: edit_gudang.php?id=' . $_SESSION['gudang_id']);
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
