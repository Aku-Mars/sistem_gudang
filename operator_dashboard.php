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
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #ccc;
        }

        header h1 {
            margin: 0;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #007bff;
        }

        .operator-dashboard-container {
            margin-top: 20px;
        }

        .gudang-list ul {
            padding: 0;
            margin: 0;
            list-style-type: none;
        }

        .gudang-list ul li {
            margin-bottom: 10px;
        }

        .create-gudang,
        .create-user {
            margin-top: 20px;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px 0;
            background-color: #f4f4f4;
            border-top: 1px solid #ccc;
        }

        /* CSS untuk tombol */
        button[type="submit"],
        .button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover,
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Sistem Penyewaan Gudang</h1>
            <nav>
                <ul>
                    <li><a href="operator_dashboard.php">Dashboard</a></li>
                    <li><a href="index.php">Logout</a></li>
                </ul>
            </nav>
        </header>
        <div class="operator-dashboard-container">
            <h2>Selamat datang, Operator!</h2>
            
            <div class="gudang-list">
                <h3>Pilih Gudang:</h3>
                <ul>
                    <?php foreach ($gudangs as $gudang): ?>
                        <li><a href="edit_gudang.php?id=<?php echo $gudang['id']; ?>"><?php echo $gudang['lokasi']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="create-gudang">
                <h3>Buat Gudang Baru:</h3>
                <form action="" method="post">
                    <label for="lokasi">Lokasi:</label>
                    <input type="text" name="lokasi" id="lokasi" required>
                    <button type="submit">Buat Gudang Baru</button>
                </form>
            </div>

            <div class="create-user">
                <h3>Membuat User Baru:</h3>
                <a href="add_user.php" class="button">Buat User</a>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Sistem Penyewaan Gudang. All rights reserved.</p>
    </footer>
</body>
</html>


