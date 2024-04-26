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
    <link rel="icon" type="image/png" href="https://cdn.discordapp.com/attachments/1038771559608881294/1211691595376623647/neko_usagi_Color_BG-removebg_1_1_1_2.png?ex=662c6c7c&is=662b1afc&hm=04d303f3b536192a025aaf143d31e7e8508bb7601a3fab7eda80c126a02ba195&">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-image: url('https://www.hashmicro.com/id/blog/wp-content/uploads/2024/01/picking-and-packing-2-scaled.jpg');
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
            text-align: center;
        }

        h3 {
            color: #333;

        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            margin-bottom: 30px; 
            text-align: center; 
        }

        ul li .thumbnail {
            width: 400px; 
            height: 400px; 
            border-radius: 20px;
            overflow: hidden;
            margin: 0 auto 20px;
            border: 2px solid #999;
        }

        ul li .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        ul li .button {
            background-color: #ffcc00; 
            color: #333; 
            padding: 20px 40px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block;
            margin: 0 auto;
            font-size: 16px;
        }

        ul li .button:hover {
            background-color: #f2b700;
        }

        form {
            margin-top: 20px;
            text-align: center; 
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

        img {
            max-width: 100%; 
            display: block;
            margin: 0 auto; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>SELAMAT DATANG, OPERATOR!</h2>
        
        <h3>Pilih Gudang:</h3>
        <ul>
            <?php foreach ($gudangs as $gudang): ?>
                <li>
                    <div class="thumbnail">
                        <img src="<?php echo $gudang['gambar']; ?>" alt="<?php echo $gudang['lokasi']; ?>">
                    </div>
                    <button class="button" onclick="location.href='edit_gudang.php?id=<?php echo $gudang['id']; ?>'"><?php echo $gudang['lokasi']; ?></button>
                </li>
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
