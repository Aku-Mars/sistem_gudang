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
    
    // Ambil data barang dari database
    $sql_barang = "SELECT * FROM barang WHERE gudang_id = $userGudangId";
    $result_barang = $conn->query($sql_barang);
    $barang = [];

    if ($result_barang->num_rows > 0) {
        while ($row = $result_barang->fetch_assoc()) {
            $barang[] = $row;
        }
    }
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
    <link rel="icon" type="image/png" href="https://cdn.discordapp.com/attachments/1038771559608881294/1211691595376623647/neko_usagi_Color_BG-removebg_1_1_1_2.png?ex=662c6c7c&is=662b1afc&hm=04d303f3b536192a025aaf143d31e7e8508bb7601a3fab7eda80c126a02ba195&">
    <style>
       
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            background-image: url('https://fwlogistics.com/wp-content/uploads/2019/09/FWL_Sept_BlogImages_1_Warehouse.jpg');
            background-size: cover; 
            background-position: center;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #009900;
            text-align: center; 
        }

        h3 {
            color: #333333; 
        }

        p {
            color: #666666; 
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #cccccc; 
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2; 
        }

        a.button {
            background-color: #009900; 
            color: #ffffff; 
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a.button:hover {
            background-color: #007700;
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
        <h2>SELAMAT DATANG, PENGGUNA!</h2>

        <?php if ($gudang): ?>
            <h3>Gudang Anda</h3>
            <img src="<?php echo $gudang['gambar']; ?>" alt="<?php echo $gudang['lokasi']; ?>">
            <p>Nama Penyewa: <?php echo $gudang['penyewa']; ?></p>
            <p>Tanggal Sewa: <?php echo $gudang['tanggal_sewa']; ?></p>
            <p>Tanggal Akhir Sewa: <?php echo $gudang['tanggal_akhir_sewa']; ?></p>
            <p>Lokasi: <?php echo $gudang['lokasi']; ?></p>
            
            <h4>List Barang:</h4>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Barang</th>
                        <th>ID Barang</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($barang as $index => $barang): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo $barang['nama_barang']; ?></td>
                            <td><?php echo $barang['id']; ?></td>
                            <td><?php echo $barang['jumlah']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Gudang tidak ditemukan untuk pengguna ini.</p>
        <?php endif; ?>

        <a href="index.php" class="button">Keluar</a>
    </div>
</body>
</html>
