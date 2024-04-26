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

// Periksa apakah parameter ID gudang telah diberikan
if (!isset($_GET['id'])) {
    echo "ID gudang tidak ditemukan";
    exit;
}

// Ambil ID gudang dari parameter URL
$gudangId = $_GET['id'];

// Periksa apakah ID gudang valid
if (!isset($gudangData[$gudangId])) {
    echo "Gudang tidak ditemukan";
    exit;
}

// Ambil data gudang yang akan diedit
$gudang = $gudangData[$gudangId];

// Proses form edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data yang diubah dari form
    $gudang['penyewa'] = $_POST['penyewa'];
    $gudang['tanggal_sewa'] = $_POST['tanggal_sewa'];
    $gudang['tanggal_akhir_sewa'] = $_POST['tanggal_akhir_sewa'];
    $gudang['lokasi'] = $_POST['lokasi'];

    // Simpan data gudang yang diperbarui ke sumber data (misalnya database atau array)
    // Di sini Anda bisa melakukan penyimpanan data ke database atau array yang sesuai
}

// Proses penambahan barang baru
if (isset($_POST['tambah_barang'])) {
    $nama_barang = $_POST['nama_barang'];
    $id_barang = $_POST['id_barang'];
    $jumlah_barang = $_POST['jumlah_barang'];

    // Tambahkan barang baru ke dalam list barang gudang
    $gudang['barang'][] = array(
        'nama' => $nama_barang,
        'id' => $id_barang,
        'jumlah' => $jumlah_barang
    );

    // Simpan data gudang yang diperbarui ke sumber data (misalnya database atau array)
    // Di sini Anda bisa melakukan penyimpanan data ke database atau array yang sesuai
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gudang</title>
    <link rel="stylesheet" href="style.css">
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

    <h3>List Barang:</h3>
    <table border="1">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>ID Barang</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($gudang['barang'] as $index => $barang): ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $barang['nama']; ?></td>
                    <td><?php echo $barang['id']; ?></td>
                    <td><?php echo $barang['jumlah']; ?></td>
                    <td>
                        <button>Edit</button>
                        <button>Hapus</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Tambah Barang Baru:</h3>
    <form action="" method="post">
        <label for="nama_barang">Nama Barang:</label>
        <input type="text" name="nama_barang" id="nama_barang" required>
        <label for="id_barang">ID Barang:</label>
        <input type="text" name="id_barang" id="id_barang" required>
        <label for="jumlah_barang">Jumlah Barang:</label>
        <input type="number" name="jumlah_barang" id="jumlah_barang" required>
        <button type="submit" name="tambah_barang">Tambah Barang</button>
    </form>

        <!-- Tombol Kembali -->
        <a href="operator_dashboard.php">Kembali</a>
</body>
</html>
