<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Atau cara lain untuk menentukan rolenya

    // Hash password sebelum menyimpannya
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashed_password, $role);

    if ($stmt->execute()) {
        echo "Pengguna berhasil ditambahkan";
    } else {
        echo "Gagal menambahkan pengguna: " . $conn->error;
    }

    $stmt->close();
}

// Ambil data gudang dari database
$sql = "SELECT id, nama FROM gudang";
$result = $conn->query($sql);
$gudangOptions = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $gudangOptions[] = $row;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna Baru</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="user-form">
        <h2>Tambah Pengguna Baru</h2>
        <form action="add_user.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role" id="role" onchange="showGudang(this.value)" required>
                <option value="" disabled selected>Pilih Peran</option>
                <option value="operator">Operator</option>
                <option value="user">User</option>
            </select>
            <select name="gudang_id" id="gudang" style="display: none;" required>
                <option value="" disabled selected>Pilih Gudang</option>
                <?php foreach ($gudangOptions as $option): ?>
                    <option value="<?php echo $option['id']; ?>"><?php echo $option['nama']; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Tambah Pengguna</button>
        </form>
    </div>

    <script>
        function showGudang(role) {
            var gudangSelect = document.getElementById("gudang");
            if (role === "user") {
                gudangSelect.style.display = "block";
            } else {
                gudangSelect.style.display = "none";
            }
        }
    </script>
</body>
</html>
