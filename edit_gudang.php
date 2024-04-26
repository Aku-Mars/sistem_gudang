<?php
session_start();

// Periksa apakah pengguna sudah login sebagai operator
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'operator') {
    header('Location: index.php');
    exit;
}

// Periksa apakah parameter ID gudang telah diberikan
if (!isset($_GET['id'])) {
    echo "ID gudang tidak ditemukan";
    exit;
}

// Ambil ID gudang dari parameter URL
$gudangId = $_GET['id'];

// Simpan data gudang dalam array (contoh)
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gudang</title>
</head>
<body>
    <h2>Edit Gudang</h2>
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
</body>
</html>
