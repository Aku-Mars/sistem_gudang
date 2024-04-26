<?php
session_start();

if ($_SESSION['role'] != 'operator') {
    header('Location: index.html');
    exit;
}

// Koneksi ke database MySQL
$servername = "localhost";
$username = "operator"; // Ganti dengan nama pengguna MySQL Anda
$password = "password123"; // Ganti dengan kata sandi MySQL Anda
$dbname = "penyewaan_gudang";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil informasi gudang
$sql = "SELECT * FROM gudang";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="dashboard-container">
        <h2>Operator Dashboard</h2>
        <!-- Tampilkan informasi gudang -->
        <ul>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<li>ID: " . $row["id"]. " - Nama Gudang: " . $row["nama_gudang"]. " - Lokasi: " . $row["lokasi"]. "</li>";
                // Anda bisa menambahkan informasi lainnya di sini
            }
        } else {
            echo "Tidak ada data gudang";
        }
        ?>
        </ul>
    </div>
</body>
</html>

<?php
// Tutup koneksi
$conn->close();
?>
