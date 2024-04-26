<?php
session_start();

// Periksa apakah pengguna sudah login sebagai user
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
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
</body>
</html>
