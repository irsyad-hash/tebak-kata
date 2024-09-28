<?php
// Konfigurasi koneksi MySQL
$host = 'localhost';
$db = 'game_scores'; // Nama database
$user = 'root';      // Username MySQL Anda
$pass = ''; // Password MySQL

// Membuat koneksi ke MySQL
$conn = new mysqli($host, $user, $pass, $db);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
