<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'operator') {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lokasi = $_POST['lokasi'];

    $sql = "INSERT INTO gudang (lokasi) VALUES ('$lokasi')";

    if ($conn->query($sql) === TRUE) {
        echo "Gudang berhasil dibuat";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM gudang";
$result = $conn->query($sql);

$gudangs = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $gudangs[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator Dashboard</title>
</head>
<body>
    <h2>Selamat datang, Operator!</h2>
    
    <h3>Pilih Gudang:</h3>
    <ul>
        <?php foreach ($gudangs as $gudang): ?>
            <li><a href="edit_gudang.php?id=<?php echo $gudang['id']; ?>"><?php echo $gudang['lokasi']; ?></a></li>
        <?php endforeach; ?>
    </ul>

    <h3>Buat Gudang Baru:</h3>
    <form action="" method="post">
        <label for="lokasi">Lokasi:</label>
        <input type="text" name="lokasi" id="lokasi" required>
        <button type="submit">Buat Gudang Baru</button>
    </form>

    <a href="index.php">Keluar</a>
</body>
</html>
