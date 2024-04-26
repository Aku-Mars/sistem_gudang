<?php
session_start();

// Simulasi autentikasi
$username = $_POST['username'];
$password = $_POST['password'];

// Cek login
if ($username === 'operator' && $password === 'operator') {
    $_SESSION['role'] = 'operator';
    header('Location: operator_dashboard.php');
} elseif ($username === 'user' && $password === 'user') {
    $_SESSION['role'] = 'user';
    header('Location: user_dashboard.php');
} else {
    echo "Login gagal. Silakan coba lagi.";
}
?>
