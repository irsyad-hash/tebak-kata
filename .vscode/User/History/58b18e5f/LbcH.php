<?php
session_start();
include 'db_config.php';

// Mengambil skor dari session
$score = $_SESSION['score'];
$wordToGuess = ''; // Reset word after displaying

// Memeriksa jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['username'];
    $stmt = $conn->prepare("INSERT INTO scores (name, score) VALUES (?, ?)");
    $stmt->bind_param("si", $name, $score);
    $stmt->execute();
    $stmt->close();
    echo "Skor Anda berhasil disimpan!<br>";
    // Reset skor setelah menyimpan
    unset($_SESSION['score']);
}

// Menutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Permainan</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<h1>Hasil Permainan</h1>
<p>Total Skor Anda: <?php echo $score; ?></p>

<form method="POST">
    <h3>Masukkan Nama untuk Menyimpan Skor:</h3>
    <input type="text" name="username" required>
    <button type="submit">Simpan Skor</button>
</form>

<a href="index.php">Main Lagi</a>

</body>
</html>
