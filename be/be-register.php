<?php
// be/be-register.php - UPDATED VERSION
require_once __DIR__ . '/../config/db-connection.php';

if (isset($_POST['register'])) {
    $name = htmlspecialchars(trim($_POST['fullname']));
    $email = htmlspecialchars(trim($_POST['email']));
    $username = htmlspecialchars(trim($_POST['username']));
    $password = $_POST['password'];
    $confirm = $_POST['confirmPassword'];

    if ($password !== $confirm) {
        echo "<script>alert('Password dan konfirmasi tidak cocok!'); window.location.href='../pages/register.php';</script>";
        exit;
    }

    // cek email
    $check = $connection->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param('s', $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email sudah digunakan!'); window.location.href='../pages/register.php';</script>";
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $connection->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $name, $email, $hashedPassword);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // ========== TAMBAHAN UNTUK PROGRESS SYSTEM ==========
        $user_id = $connection->insert_id;
        
        // Initialize category ranks untuk user baru
        $categories = ['IPS', 'Bahasa Inggris', 'MTK', 'IPA', 'Bahasa Indonesia', 'IPAS'];
        $rankStmt = $connection->prepare("INSERT INTO category_ranks (user_id, category, rank_level) VALUES (?, ?, 0)");
        
        foreach ($categories as $category) {
            $rankStmt->bind_param('is', $user_id, $category);
            try {
                $rankStmt->execute();
            } catch (Exception $e) {
                error_log("Failed to initialize rank for category $category: " . $e->getMessage());
            }
        }
        $rankStmt->close();
        // ===================================================
        
        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href='../pages/login.php';</script>";
        exit;
    } else {
        echo "<script>alert('Terjadi kesalahan saat registrasi.'); window.location.href='../pages/register.php';</script>";
        exit;
    }
    
    $stmt->close();
}
?>