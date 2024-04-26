<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    header('Location: index.php');
    exit;
}

$userGudangId = $_SESSION['gudang_id'];

$sql = "SELECT * FROM gudang WHERE id = $userGudangId";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $gudang = $result->fetch_assoc();
} else {
    $gudang = null;
}

$conn->close();
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

    <?php if ($gudang): ?>
        <h3>Gudang Anda</h3>
        <p>Nama Penyewa: <?php echo $gudang['penyewa']; ?></p>
        <p>Tanggal Sewa: <?php echo $gudang['tanggal_sewa']; ?></p>
        <p>Tanggal Akhir Sewa: <?php echo $gudang['tanggal_akhir_sewa']; ?></p>
        <p>Lokasi: <?php echo $gudang['lokasi']; ?></p>
        
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
                <?php foreach ($gudang['barang'] as $index => $barang): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo $barang['nama']; ?></td>
                        <td><?php echo $barang['id']; ?></td>
                        <td><?php echo $barang['jumlah']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Gudang tidak ditemukan untuk pengguna ini.</p>
    <?php endif; ?>

    <a href="index.php">Keluar</a>
</body>
</html>
