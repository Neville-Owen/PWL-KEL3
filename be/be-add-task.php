<?php
session_start();
require_once '../config/db-connection.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../pages/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user']['id'];
    $subject = $_POST['subject'];
    $task_name = $_POST['task_name'];
    $difficulty = $_POST['difficulty'];
    $weight = intval($_POST['weight']);
    
    $stmt = $connection->prepare("INSERT INTO tasks (user_id, subject, task_name, difficulty, weight, status) VALUES (?, ?, ?, ?, ?, 'pending')");
    $stmt->bind_param("isssi", $user_id, $subject, $task_name, $difficulty, $weight);
    
    if ($stmt->execute()) {
        $_SESSION['success_message'] = 'Tugas berhasil ditambahkan!';
    } else {
        $_SESSION['error_message'] = 'Gagal menambahkan tugas!';
    }
    
    $stmt->close();
    header('Location: ../pages/proggres.php');
    exit;
}
?>