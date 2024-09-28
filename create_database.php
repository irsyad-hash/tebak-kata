<?php
include 'db_config.php'; // Mengimpor file konfigurasi database

// Membuat database jika belum ada
$sql = "CREATE DATABASE IF NOT EXISTS $dbName";
if ($conn->query($sql) === TRUE) {
    echo "Database '$dbName' berhasil dibuat atau sudah ada.<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Menggunakan database yang baru dibuat
$conn->select_db($dbName);

// Membuat tabel 'scores' jika belum ada
$sql = "CREATE TABLE IF NOT EXISTS scores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    score INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabel 'scores' berhasil dibuat atau sudah ada.<br>";
} else {
    echo "Error creating table 'scores': " . $conn->error . "<br>";
}

// Membuat tabel 'words' jika belum ada
$sql = "CREATE TABLE IF NOT EXISTS words (
    id INT AUTO_INCREMENT PRIMARY KEY,
    word VARCHAR(100) NOT NULL,
    description VARCHAR(255) NOT NULL  -- Menambahkan kolom deskripsi
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabel 'words' berhasil dibuat atau sudah ada.<br>";
} else {
    echo "Error creating table 'words': " . $conn->error . "<br>";
}

// Menutup koneksi
$conn->close();
?>
