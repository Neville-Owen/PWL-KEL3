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
