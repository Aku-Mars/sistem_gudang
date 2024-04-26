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

        .button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            display: inline-block;
        }

        .button:hover {
            background-color: #0056b3;
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
            $barangId = $_POST['barang_id'];

            $sql = "DELETE FROM barang WHERE id=$barangId";

            if ($conn->query($sql) === TRUE) {
                echo "Barang berhasil dihapus";
                // Periksa apakah $_SESSION['gudang_id'] memiliki nilai
                if (isset($_SESSION['gudang_id']) && $_SESSION['gudang_id'] !== '') {
                    $gudangId = $_SESSION['gudang_id'];
                    header('Refresh: 1.5; URL=edit_gudang.php?id=' . $gudangId);
                    exit;
                } else {
                    echo "Gudang ID tidak valid";
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        
        $conn->close();
        ?>
    </div>
</body>
</html>
