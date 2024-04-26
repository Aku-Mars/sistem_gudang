<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header('Location: index.html');
    exit();
}
// Kode untuk menampilkan dashboard user
?>
