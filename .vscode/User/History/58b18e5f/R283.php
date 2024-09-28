<?php
// result.php
session_start();

$score = $_SESSION['score'];
$wordToGuess = $_SESSION['word'];
$results = $_SESSION['results'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db_config.php';
    $name = $_POST['username'];
    $stmt = $conn->prepare("INSERT INTO scores (name, score, date_time) VALUES (?, ?, NOW())");
    $stmt->bind_param("si", $name, $score);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Reset skor dan kata setelah menyimpan
    unset($_SESSION['score']);
    unset($_SESSION['word']);
    unset($_SESSION['results']);

    header('Location: index.php');
    exit();
}
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
    <div class="container">
        <h1>Hasil Permainan</h1>
        <p>Kata yang benar: <?php echo $wordToGuess; ?></p>
        <div class="result-word">
            <?php foreach ($results as $result): ?>
                <span class="letter <?php echo $result['class']; ?>">
                    <?php echo $result['letter']; ?>
                    <small><?php echo $result['points']; ?></small>
                </span>
            <?php endforeach; ?>
        </div>
        <p class="total-score">Total Skor: <?php echo $score; ?></p>
        
        <form method="POST" class="save-score-form">
            <h3>Masukkan Nama untuk Menyimpan Skor:</h3>
            <input type="text" name="username" required class="name-input">
            <button type="submit" class="save-btn">SIMPAN POINT</button>
        </form>
        
        <a href="index.php" class="replay-btn">ULANGI</a>
    </div>
</body>
</html>