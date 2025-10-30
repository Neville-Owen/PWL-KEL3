<?php
require_once 'config.php';

if (isset($_SESSION['user_id'])) {
    try {
        $pdo = getDBConnection();
        $stmt = $pdo->prepare("DELETE FROM sessions WHERE user_id = ?");
        $stmt->execute([$_SESSION['user_id']]);
    } catch (PDOException $e) {
        error_log("Logout Error: " . $e->getMessage());
    }
}

session_unset();
session_destroy();

header('Location: login.php');
exit;
?>