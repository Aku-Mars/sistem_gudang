<?php
session_start();

// Data operator dan user
$users = array(
    'operator' => array(
        'username' => 'operator',
        'password' => 'password123',
        'role' => 'operator'
    ),
    'user1' => array(
        'username' => 'user1',
        'password' => 'user123',
        'role' => 'user',
        'gudang' => 1
    ),
    'user2' => array(
        'username' => 'user2',
        'password' => 'user456',
        'role' => 'user',
        'gudang' => 2
    )
);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Periksa kecocokan username dan password
    if (isset($users[$username]) && $users[$username]['password'] === $password) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $users[$username]['role'];
        $_SESSION['gudang'] = isset($users[$username]['gudang']) ? $users[$username]['gudang'] : null;

        // Redirect sesuai peran (role)
        if ($_SESSION['role'] === 'operator') {
            header('Location: operator_dashboard.php');
        } elseif ($_SESSION['role'] === 'user') {
            header('Location: user_dashboard.php');
        }
        exit;
    } else {
        echo "Username atau password salah";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Penyewaan Gudang</title>
    <link rel="stylesheet" href="style.css">
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
