<?php
// create_database.php

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
    echo "Error creating table: " . $conn->error . "<br>";
}

// Data awal yang akan dimasukkan
$seedData = [
    ['name' => 'Alice', 'score' => 100],
    ['name' => 'Bob', 'score' => 85],
    ['name' => 'Charlie', 'score' => 70],
    ['name' => 'David', 'score' => 90],
    ['name' => 'Eve', 'score' => 75],
];

// Memasukkan data ke database
foreach ($seedData as $data) {
    $stmt = $conn->prepare("INSERT INTO scores (name, score) VALUES (?, ?)");
    $stmt->bind_param("si", $data['name'], $data['score']);
    
    // Mengeksekusi pernyataan
    if ($stmt->execute()) {
        echo "Data untuk " . $data['name'] . " berhasil disimpan.<br>";
    } else {
        echo "Gagal menyimpan data untuk " . $data['name'] . ": " . $conn->error . "<br>";
    }
}

// Menutup koneksi
$stmt->close();
$conn->close();
?>
