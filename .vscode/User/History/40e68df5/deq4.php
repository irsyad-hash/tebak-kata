<?php
// db_config.php

// Konfigurasi koneksi ke MySQL
$host = 'localhost';
$user = 'root'; // Ganti dengan username MySQL Anda
$pass = ''; // Ganti dengan password MySQL Anda
$dbName = 'game_scores';

// Membuat koneksi ke MySQL
$conn = new mysqli($host, $user, $pass);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
