<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password, role, gudang_id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);

    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $username, $hashed_password, $role, $gudang_id);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            $_SESSION['gudang_id'] = $gudang_id;

            if ($role === 'operator') {
                header('Location: operator_dashboard.php');
            } elseif ($role === 'user') {
                header('Location: user_dashboard.php');
            }
            exit;
        } else {
            echo "Username atau password salah";
        }
    } else {
        echo "Username atau password salah";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Penyewaan Gudang</title>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="index.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
