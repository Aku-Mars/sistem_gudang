<?php
session_start();

// Periksa apakah pengguna sudah login sebagai user
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    header('Location: index.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
    <h2>Selamat datang, User!</h2>
    <h3>Gudang 1</h3>
    <p>Nama Penyewa: <?php echo $gudangData[1]['penyewa']; ?></p>
    <p>Tanggal Sewa: <?php echo $gudangData[1]['tanggal_sewa']; ?></p>
    <p>Tanggal Akhir Sewa: <?php echo $gudangData[1]['tanggal_akhir_sewa']; ?></p>
    <p>Lokasi: <?php echo $gudangData[1]['lokasi']; ?></p>
    
    <h4>List Barang:</h4>
    <table border="1">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>ID Barang</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($gudangData[1]['barang'] as $index => $barang): ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $barang['nama']; ?></td>
                    <td><?php echo $barang['id']; ?></td>
                    <td><?php echo $barang['jumlah']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index.php">Keluar</a>
</body>
</html>
