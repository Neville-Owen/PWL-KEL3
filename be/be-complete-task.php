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
    
    // Ambil data tugas
    $stmt = $connection->prepare("SELECT subject, difficulty, weight FROM tasks WHERE id = ? AND user_id = ? AND status = 'pending'");
    $stmt->bind_param("ii", $task_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $task = $result->fetch_assoc();
        $subject = $task['subject'];
        $difficulty = $task['difficulty'];
        $weight = $task['weight'];
        
        // Hitung reward
        $exp_base = array('Mudah' => 50, 'Sedang' => 100, 'Sulit' => 200);
        $points_base = array('Mudah' => 75, 'Sedang' => 150, 'Sulit' => 300);
        
        $exp_reward = round($exp_base[$difficulty] * ($weight / 10));
        $points_reward = round($points_base[$difficulty] * ($weight / 10));
        
        // Update status tugas menjadi completed
        $stmt2 = $connection->prepare("UPDATE tasks SET status = 'completed', completed_at = NOW() WHERE id = ?");
        $stmt2->bind_param("i", $task_id);
        $stmt2->execute();
        
        // Update progress subject
        $stmt3 = $connection->prepare("SELECT current_progress FROM subject_progress WHERE user_id = ? AND subject = ?");
        $stmt3->bind_param("is", $user_id, $subject);
        $stmt3->execute();
        $progress_result = $stmt3->get_result();
        
        if ($progress_result->num_rows > 0) {
            $current = $progress_result->fetch_assoc()['current_progress'];
            $new_progress = $current + $weight;
            
            // Cek apakah sudah 100%
            $rank_up = false;
            if ($new_progress >= 100) {
                $new_progress = 0;
                $rank_up = true;
            }
            
            $stmt4 = $connection->prepare("UPDATE subject_progress SET current_progress = ?, total_completed = total_completed + 1 WHERE user_id = ? AND subject = ?");
            $stmt4->bind_param("dis", $new_progress, $user_id, $subject);
            $stmt4->execute();
        } else {
            // Insert progress baru
            $new_progress = $weight;
            if ($new_progress >= 100) {
                $new_progress = 0;
                $rank_up = true;
            }
            
            $stmt4 = $connection->prepare("INSERT INTO subject_progress (user_id, subject, current_progress, total_completed) VALUES (?, ?, ?, 1)");
            $stmt4->bind_param("isd", $user_id, $subject, $new_progress);
            $stmt4->execute();
        }
        
        // Update user stats
        $stmt5 = $connection->prepare("SELECT exp, rank_name FROM user_stats WHERE user_id = ?");
        $stmt5->bind_param("i", $user_id);
        $stmt5->execute();
        $stats_result = $stmt5->get_result();
        
        if ($stats_result->num_rows > 0) {
            $stats = $stats_result->fetch_assoc();
            $new_exp = $stats['exp'] + $exp_reward;
            $old_rank = $stats['rank_name'];
            
            // Tentukan rank baru
            $new_rank = 'Novice';
            if ($new_exp >= 10000) $new_rank = 'Grandmaster';
            elseif ($new_exp >= 5000) $new_rank = 'Master';
            elseif ($new_exp >= 3000) $new_rank = 'Expert';
            elseif ($new_exp >= 1500) $new_rank = 'Skilled';
            elseif ($new_exp >= 500) $new_rank = 'Apprentice';
            
            $stmt6 = $connection->prepare("UPDATE user_stats SET exp = exp + ?, points = points + ?, total_completed = total_completed + 1, rank_name = ? WHERE user_id = ?");
            $stmt6->bind_param("iisi", $exp_reward, $points_reward, $new_rank, $user_id);
            $stmt6->execute();
            
            if ($old_rank != $new_rank) {
                $_SESSION['rank_up_message'] = "Selamat! Kamu naik rank menjadi " . $new_rank . "!";
            }
        } else {
            // Insert stats baru
            $new_exp = $exp_reward;
            $new_rank = 'Novice';
            
            $stmt6 = $connection->prepare("INSERT INTO user_stats (user_id, exp, points, total_completed, rank_name) VALUES (?, ?, ?, 1, ?)");
            $stmt6->bind_param("iiis", $user_id, $exp_reward, $points_reward, $new_rank);
            $stmt6->execute();
        }
        
        $_SESSION['success_message'] = "Tugas selesai! +" . $exp_reward . " EXP, +" . $points_reward . " Points";
    }
    
    header('Location: ../pages/proggres.php');
    exit;
}
?>