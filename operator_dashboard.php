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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2, h3 {
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            margin-bottom: 10px;
        }

        ul li a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #999; 
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        ul li a:hover {
            background-color: #ccc; 
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
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
    </style>
</head>
<body>
    <div class="container">
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

        <a href="index.php" class="button">Keluar</a>
    </div>
</body>
</html>




