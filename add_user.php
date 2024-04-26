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
            <select name="role">
                <option value="operator">Operator</option>
                <option value="user">User</option>
            </select>
            <button type="submit">Tambah Pengguna</button>
        </form>
    </div>
</body>
</html>
