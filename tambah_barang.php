<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .notification {
            text-align: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f3f3f3;
        }
    </style>
</head>
<body>
    <div class="notification">
        <?php
        session_start();
        include 'db_connection.php';

        if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'operator') {
            header('Location: index.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $gudangId = $_POST['gudang_id'];
            $nama_barang = $_POST['nama_barang'];
            $jumlah_barang = $_POST['jumlah_barang'];

            // Pastikan gudang dengan ID yang dimaksud ada
            $sql = "SELECT * FROM gudang WHERE id=$gudangId";
            $result = $conn->query($sql);
            if ($result->num_rows == 0) {
                echo "Gudang tidak ditemukan";
                exit;
            }

            // Insert data barang baru ke dalam database
            $sql = "INSERT INTO barang (gudang_id, nama_barang, jumlah) VALUES ($gudangId, '$nama_barang', $jumlah_barang)";
            if ($conn->query($sql) === TRUE) {
                echo "Barang berhasil ditambahkan";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        $conn->close();

        // Mengarahkan kembali ke halaman sebelumnya setelah 1.5 detik
        header('Refresh: 1.5; URL=edit_gudang.php?id=' . $gudangId);
        ?>
    </div>
</body>
</html>
