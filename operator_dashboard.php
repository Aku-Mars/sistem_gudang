<?php
session_start();

// Periksa apakah pengguna sudah login sebagai operator
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'operator') {
    header('Location: index.php');
    exit;
}

// Data dummy gudang (contoh)
$gudangData = array(
    1 => array(
        'penyewa' => 'Penyewa A',
        'tanggal_sewa' => '2024-04-27',
        'tanggal_akhir_sewa' => '2024-05-27',
        'lokasi' => 'Lokasi A',
        'barang' => array(
            array('nama' => 'Barang 1', 'id' => '1', 'jumlah' => 5),
            array('nama' => 'Barang 2', 'id' => '2', 'jumlah' => 10)
        )
    ),
    2 => array(
        'penyewa' => 'Penyewa B',
        'tanggal_sewa' => '2024-04-28',
        'tanggal_akhir_sewa' => '2024-05-28',
        'lokasi' => 'Lokasi B',
        'barang' => array(
            array('nama' => 'Barang 3', 'id' => '3', 'jumlah' => 8),
            array('nama' => 'Barang 4', 'id' => '4', 'jumlah' => 12)
        )
    )
);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Selamat datang, Operator!</h2>
    
    <h3>Pilih Gudang:</h3>
    <ul>
        <li><a href="edit_gudang.php?id=1">Gudang 1</a></li>
        <li><a href="edit_gudang.php?id=2">Gudang 2</a></li>
        <!-- Tambahkan gudang lain jika ada -->
    </ul>
</body>
</html>
