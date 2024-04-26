<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'operator') {
    header('Location: index.php');
    exit;
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
    <a href="index.php">Keluar</a>
</body>
</html>
