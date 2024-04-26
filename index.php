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
    <link rel="icon" type="image/png" href="https://cdn.discordapp.com/attachments/1038771559608881294/1211691595376623647/neko_usagi_Color_BG-removebg_1_1_1_2.png?ex=662c6c7c&is=662b1afc&hm=04d303f3b536192a025aaf143d31e7e8508bb7601a3fab7eda80c126a02ba195&">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url('https://mmproperty.com/wp-content/uploads/2021/03/2.-Pentingnya-Sewa-Gudang-Jakarta-beserta-Masing-Masing-Fungsinya.jpg');
            background-size: cover; 
            background-position: center;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-container form {
            display: flex;
            flex-direction: column;
        }

        .login-container input[type="text"],
        .login-container input[type="password"],
        .login-container button {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .login-container button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Selamat Datang!</h2>
        <form action="index.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>

