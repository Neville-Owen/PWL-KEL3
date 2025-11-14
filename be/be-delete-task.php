<?php
session_start();
require_once '../config/db-connection.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../pages/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user']['id'];
    $task_id = intval($_POST['task_id']);
    
    $stmt = $connection->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $task_id, $user_id);
    
    if ($stmt->execute()) {
        $_SESSION['success_message'] = 'Tugas berhasil dihapus!';
    } else {
        $_SESSION['error_message'] = 'Gagal menghapus tugas!';
    }
    
    $stmt->close();
    header('Location: ../pages/proggres.php');
    exit;
}
?>
