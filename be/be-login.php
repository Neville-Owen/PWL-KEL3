<?php
require_once __DIR__ . '/../config/db-connection.php';
session_start();

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $connection->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email']
        ];
        
        // Redirect ke beranda setelah login
        header('Location: ../pages/beranda.php');
        exit;
    } else {
        echo "<script>alert('Email atau password salah!'); window.location.href='../pages/login.php';</script>";
        exit;
    }
}
?>