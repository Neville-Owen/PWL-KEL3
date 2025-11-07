<?php
require_once '../../config/db-connection.php';
session_start();

if (isset($_POST['login'])) {
    //Ambil inputan user
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Panggil Perintah SQL untuk cek user
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    
    // Dapatkan data user
    $user = $stmt->get_result()->fetch_assoc(); 

    //Cek apakah user ditemukan
    if(isset($user)) {
        //Handle jika data pengguna ada
        $isPasswordMatch = password_verify($password, $user['password']);
    if($isPasswordMatch) {
            //Password benar, simpan session
            $_SESSION['user'] = $user;
            //Redirect ke dashboard
            header('Location: ../../pages/dashboard/index.php');
            exit();
        } else {
            //Password salah
            echo 
            "<script>
            alert('email or password wrong'); window.location.href='../../pages/login/index.php';
            </script>";
            exit();
        }
    }

}
    
?>