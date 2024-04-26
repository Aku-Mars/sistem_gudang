<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'operator') {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gudangId = $_GET['id'];
    $penyewa = $_POST['penyewa'];
    $tanggal_sewa = $_POST['tanggal_sewa'];
    $tanggal_akhir_sewa = $_POST['tanggal_akhir_sewa'];
    $lokasi = $_POST['lokasi'];

    $sql = "UPDATE gudang SET penyewa='$penyewa', tanggal_sewa='$tanggal_sewa', tanggal_akhir_sewa='$tanggal_akhir_sewa', lokasi='$lokasi' WHERE id=$gudangId";

    if ($conn->query($sql) === TRUE) {
        echo "Data gudang berhasil diperbarui";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$gudangId = $_GET['id'];
$sql = "SELECT * FROM gudang WHERE id=$gudangId";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $gudang = $result->fetch_assoc();
} else {
    echo "Gudang tidak ditemukan";
    exit;
}

// Ambil data barang dari database
$sql_barang = "SELECT * FROM barang WHERE id_gudang=$gudangId";
$result_barang = $conn->query($sql_barang);
$barang = [];
if ($result_barang->num_rows > 0) {
    while ($row = $result_barang->fetch_assoc()) {
        $barang[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gudang</title>
</head>
<body>
    <h2>Edit Gudang <?php echo $gudangId; ?></h2>
    <form action="" method="post">
        <label for="penyewa">Nama Penyewa:</label>
        <input type="text" name="penyewa" id="penyewa" value="<?php echo $gudang['penyewa']; ?>" required>
        <label for="tanggal_sewa">Tanggal Sewa:</label>
        <input type="date" name="tanggal_sewa" id="tanggal_sewa" value="<?php echo $gudang['tanggal_sewa']; ?>" required>
        <label for="tanggal_akhir_sewa">Tanggal Akhir Sewa:</label>
        <input type="date" name="tanggal_akhir_sewa" id="tanggal_akhir_sewa" value="<?php echo $gudang['tanggal_akhir_sewa']; ?>" required>
        <label for="lokasi">Lokasi:</label>
        <input type="text" name="lokasi" id="lokasi" value="<?php echo $gudang['lokasi']; ?>" required>
        <button type="submit">Simpan Perubahan</button>
    </form>

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

    <h3>Tambah Barang Baru:</h3>
    <form action="" method="post">
        <label for="nama_barang">Nama Barang:</label>
        <input type="text" name="nama_barang" id="nama_barang" required>
        <label for="jumlah_barang">Jumlah Barang:</label>
        <input type="number" name="jumlah_barang" id="jumlah_barang" required>
        <button type="submit">Tambah Barang</button>
    </form>

    <a href="operator_dashboard.php">Kembali</a>
</body>
</html>
