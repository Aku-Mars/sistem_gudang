<?php
session_start();

// Check login credentials (dummy example)
if ($_POST['username'] == 'operator' && $_POST['password'] == 'operatorpass') {
    $_SESSION['role'] = 'operator';
    header('Location: operator_dashboard.php');
} elseif ($_POST['username'] == 'user' && $_POST['password'] == 'userpass') {
    $_SESSION['role'] = 'user';
    header('Location: user_dashboard.php');
} else {
    // Redirect back to login page with error message
    header('Location: index.html?error=1');
}
?>
