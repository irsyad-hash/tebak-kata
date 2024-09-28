<?php
include 'db_config.php'; // Mengimpor file konfigurasi database

// Data kata dan deskripsi yang akan dimasukkan
$seedWords = [
    'LEMARI' => 'Aku adalah furnitur yang sering ada di kamar tidur. Aku memiliki pintu dan seringkali ada beberapa rak di dalamnya.',
    'MEJA' => 'Aku adalah furnitur datar yang sering digunakan untuk bekerja atau makan.',
    'KURSİ' => 'Aku adalah tempat duduk yang biasanya memiliki sandaran dan digunakan di meja.',
    'BANGKU' => 'Aku adalah tempat duduk panjang yang biasanya bisa menampung beberapa orang.',
    'PULPEN' => 'Aku adalah alat tulis yang digunakan untuk menulis atau menggambar.',
    'KOMPUTER' => 'Aku adalah perangkat elektronik yang digunakan untuk memproses data dan informasi.',
];

// Memasukkan data ke database
foreach ($seedWords as $word => $description) {
    $stmt = $conn->prepare("INSERT INTO words (word, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $word, $description);
    
    // Mengeksekusi pernyataan
    if ($stmt->execute()) {
        echo "Kata '$word' dengan deskripsi berhasil disimpan.<br>";
    } else {
        echo "Gagal menyimpan kata '$word': " . $conn->error . "<br>";
    }
}

// Menutup koneksi
$stmt->close();
$conn->close();
?>
