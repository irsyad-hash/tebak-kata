<?php
session_start();
include 'db_config.php'; // Mengimpor file konfigurasi database

// Mengambil kata acak dan deskripsi dari tabel 'words'
$result = $conn->query("SELECT word, description FROM words ORDER BY RAND() LIMIT 1");
$row = $result->fetch_assoc();
$wordToGuess = $row['word'];
$question = $row['description']; // Mengambil deskripsi sebagai pertanyaan

// Menginisialisasi skor
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}

// Menghitung jumlah huruf dalam kata
$wordLength = strlen($wordToGuess);

// Memeriksa jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userInput = $_POST['letters'];
    $correctCount = 0;
    $wrongCount = 0;

    // Menghitung skor berdasarkan input pengguna
    for ($i = 0; $i < $wordLength; $i++) {
        // Menggunakan strtolower untuk membuat perbandingan case-insensitive
        if (strtolower($userInput[$i]) === strtolower($wordToGuess[$i])) {
            $_SESSION['score'] += 10; // +10 untuk huruf yang benar
            $correctCount++;
        } else {
            $_SESSION['score'] -= 2; // -2 untuk huruf yang salah
            $wrongCount++;
            if ($i === 2 || $i === 6) { // Jika huruf ke-3 atau ke-7
                $_SESSION['score'] += 0; // Tidak mengubah skor
            }
        }
    }

    // Memeriksa apakah kata yang ditebak benar atau tidak
    if ($correctCount === $wordLength) {
        // Kata benar, simpan skor ke database
        $stmt = $conn->prepare("INSERT INTO scores (name, score) VALUES (?, ?)");
        $name = "Player"; // Ganti dengan nama pemain yang sesuai
        $stmt->bind_param("si", $name, $_SESSION['score']);
        $stmt->execute();
        $stmt->close();
    } else {
        // Kata salah, reset skor ke 0
        $_SESSION['score'] = 0;
    }

    // Set skor ke session dan redirect
    header('Location: result.php'); // Redirect ke halaman hasil
    exit();
}

// Menutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permainan Tebak Kata</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<h1>Permainan Tebak Kata</h1>
<p><?php echo $question; ?></p> <!-- Menampilkan pertanyaan -->
<p>Ayo tebak kata berikut:</p>

<form method="POST">
    <?php for ($i = 0; $i < $wordLength; $i++): ?>
        <?php if ($i === 2 || $i === 6): ?>
            <input type="text" value="<?php echo $wordToGuess[$i]; ?>" readonly style="width: 30px;">
        <?php else: ?>
            <input type="text" name="letters[]" maxlength="1" style="width: 30px;">
        <?php endif; ?>
    <?php endfor; ?>
    <div class="input-box">
        <button type="submit">Jawab</button>
    </div>
</form>

</body>
</html>
