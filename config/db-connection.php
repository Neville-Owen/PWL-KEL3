<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "questify";

$connection = new mysqli($host, $username, $password, $database);

if ($connection->connect_error) {
    die("Koneksi database gagal: " . $connection->connect_error);
}
?>

<?php
// config/db-connection.php - SUDAH ADA, TIDAK PERLU DIUBAH
// File ini sudah benar dan akan digunakan untuk progress system

$host = "localhost";
$username = "root";
$password = "";
$database = "questify";

$connection = new mysqli($host, $username, $password, $database);

if ($connection->connect_error) {
    die("Koneksi database gagal: " . $connection->connect_error);
}

// Helper function untuk initialize category ranks untuk user baru
function initializeCategoryRanks($connection, $user_id) {
    $categories = ['IPS', 'Bahasa Inggris', 'MTK', 'IPA', 'Bahasa Indonesia', 'IPAS'];
    
    $stmt = $connection->prepare("INSERT INTO category_ranks (user_id, category, rank_level) VALUES (?, ?, 0)");
    
    foreach ($categories as $category) {
        $stmt->bind_param('is', $user_id, $category);
        try {
            $stmt->execute();
        } catch (Exception $e) {
            // Ignore duplicate entry errors
            if ($connection->errno != 1062) {
                error_log("Error initializing rank: " . $e->getMessage());
            }
        }
    }
    $stmt->close();
}
?>