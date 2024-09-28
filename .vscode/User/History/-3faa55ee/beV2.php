<?php
include 'db_config.php';

// Mendapatkan data dari form
$name = $_POST['name'];
$score = $_POST['score'];

// Menyimpan data ke database
$stmt = $conn->prepare("INSERT INTO scores (name, score) VALUES (?, ?)");
$stmt->bind_param("si", $name, $score);

if ($stmt->execute()) {
    echo "Skor berhasil disimpan! <br>";
} else {
    echo "Gagal menyimpan skor!";
}

$stmt->close();
$conn->close();
?>

<a href="index.php">Main Lagi</a>
