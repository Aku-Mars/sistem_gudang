<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'operator') {
    header('Location: index.php');
    exit;
}

// Fungsi untuk mengambil list barang dari database
function getListBarang($conn, $gudangId) {
    $sql = "SELECT * FROM barang WHERE gudang_id=$gudangId";
    $result = $conn->query($sql);
    $barang = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $barang[] = $row;
        }
    }
    return $barang;
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

// Ambil list barang dari database
$barang = getListBarang($conn, $gudangId);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gudang</title>
    <link rel="icon" type="image/png" href="https://cdn.discordapp.com/attachments/1038771559608881294/1211691595376623647/neko_usagi_Color_BG-removebg_1_1_1_2.png?ex=662c6c7c&is=662b1afc&hm=04d303f3b536192a025aaf143d31e7e8508bb7601a3fab7eda80c126a02ba195&">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-image: url('https://i0.wp.com/shipper.id/wp-content/uploads/2023/09/Gudang-dan-Warehouse-Management-System-Ketahui-Perbedaannya-di-Sini.webp?fit=1024%2C683&ssl=1');
            background-size: cover; 
            background-position: center;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            font-size: 1.2em;
            text-align: center; 
        }

        h3 {
            color: #333;
            font-size: 1.2em;
            text-align: center; 
        }

        form {
            margin-top: 20px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="date"],
        input[type="number"] {
            width: calc(100% - 22px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        button[type="submit"], a.button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover, a.button:hover {
            background-color: #0056b3;
        }

        .button {
            margin-top: 20px;
            display: inline-block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            max-width: 400px;
            margin-left: auto; 
            margin-right: auto; 
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 100%; 
            display: block;
            margin: 0 auto; 
        }
    </style>
</head>
<body>
    <div class="container"> 
        <h2>SEKRETARIAT GUDANG</h2>
        <img src="<?php echo $gudang['gambar']; ?>" alt="<?php echo $gudang['lokasi']; ?>">
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
        <table>
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($barang as $b): ?>
                    <tr>
                        <td><?php echo $b['nama_barang']; ?></td>
                        <td><?php echo $b['jumlah']; ?></td>
                        <td>
                            <form action="hapus_barang.php" method="post">
                                <input type="hidden" name="barang_id" value="<?php echo $b['id']; ?>">
                                <button type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Tambah Barang Baru:</h3>
        <form action="tambah_barang.php" method="post">
            <input type="hidden" name="gudang_id" value="<?php echo $gudangId; ?>">
            <label for="nama_barang">Nama Barang:</label>
            <input type="text" name="nama_barang" id="nama_barang" required>
            <label for="jumlah_barang">Jumlah Barang:</label>
            <input type="number" name="jumlah_barang" id="jumlah_barang" required>
            <button type="submit">Tambah Barang</button>
        </form>

        <a href="operator_dashboard.php" class="button">Kembali</a>
    </div>
</body>
</html>
