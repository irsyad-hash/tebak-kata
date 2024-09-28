<?php
include 'db_config.php'; // Mengimpor file konfigurasi database

// Data kata yang akan dimasukkan
$seedWords = [
    'LEMARI',
    'MEJA',
    'KURSİ',
    'BANGKU',
    'PEN',
    'KOMPUTER',
];

// Memasukkan data ke database
foreach ($seedWords as $word) {
    $stmt = $conn->prepare("INSERT INTO words (word) VALUES (?)");
    $stmt->bind_param("s", $word);
    
    // Mengeksekusi pernyataan
    if ($stmt->execute()) {
        echo "Kata '$word' berhasil disimpan.<br>";
    } else {
        echo "Gagal menyimpan kata '$word': " . $conn->error . "<br>";
    }
}

// Menutup koneksi
$stmt->close();
$conn->close();
?>
