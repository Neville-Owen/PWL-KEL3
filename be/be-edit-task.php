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
    $task_name = $_POST['task_name'];
    $difficulty = $_POST['difficulty'];
    $weight = intval($_POST['weight']);
    
    $stmt = $connection->prepare("UPDATE tasks SET task_name = ?, difficulty = ?, weight = ? WHERE id = ? AND user_id = ? AND status = 'pending'");
    $stmt->bind_param("ssiii", $task_name, $difficulty, $weight, $task_id, $user_id);
    
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $_SESSION['success_message'] = 'Tugas berhasil diperbarui!';
        } else {
            $_SESSION['error_message'] = 'Tugas tidak ditemukan atau sudah selesai!';
        }
    } else {
        $_SESSION['error_message'] = 'Gagal memperbarui tugas!';
    }
    
    $stmt->close();
    header('Location: ../pages/proggres.php');
    exit;
}
?>