<?php
// index.php
session_start();
include 'db_config.php';

// Mengambil kata acak dan deskripsi dari tabel 'words'
$result = $conn->query("SELECT word, description FROM words ORDER BY RAND() LIMIT 1");
$row = $result->fetch_assoc();
$wordToGuess = strtoupper($row['word']);
$question = $row['description'];

// Menginisialisasi skor
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}

$wordLength = strlen($wordToGuess);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userInput = array_map('strtoupper', $_POST['letters']);
    $correctCount = 0;
    $score = 0;

    for ($i = 0; $i < $wordLength; $i++) {
        if ($userInput[$i] === $wordToGuess[$i]) {
            $score += 10;
            $correctCount++;
        } elseif ($i !== 2 && $i !== 6) {
            $score -= 2;
        }
    }

    $_SESSION['score'] = $score;
    $_SESSION['word'] = $wordToGuess;
    $_SESSION['user_input'] = $userInput;

    header('Location: result.php');
    exit();
}

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
    <p><?php echo $question; ?></p>
    <p>Ayo tebak kata berikut:</p>
    <form method="POST">
        <?php for ($i = 0; $i < $wordLength; $i++): ?>
            <?php if ($i === 2 || $i === 6): ?>
                <input type="text" name="letters[]" value="<?php echo $wordToGuess[$i]; ?>" readonly style="width: 30px;">
            <?php else: ?>
                <input type="text" name="letters[]" maxlength="1" style="width: 30px;" required>
            <?php endif; ?>
        <?php endfor; ?>
        <div class="input-box">
            <button type="submit">Jawab</button>
        </div>
    </form>
</body>
</html>

<?php
// result.php
session_start();
include 'db_config.php';

$score = $_SESSION['score'];
$wordToGuess = $_SESSION['word'];
$userInput = $_SESSION['user_input'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['username'];
    $stmt = $conn->prepare("INSERT INTO scores (name, score, date_time) VALUES (?, ?, NOW())");
    $stmt->bind_param("si", $name, $score);
    $stmt->execute();
    $stmt->close();

    // Reset skor dan kata setelah menyimpan
    unset($_SESSION['score']);
    unset($_SESSION['word']);
    unset($_SESSION['user_input']);

    header('Location: index.php');
    exit();
}

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
    <p>Kata yang benar: <?php echo $wordToGuess; ?></p>
    <p>Jawaban Anda: <?php echo implode('', $userInput); ?></p>
    <p>Point yang Anda dapat adalah: <?php echo $score; ?></p>
    
    <form method="POST">
        <h3>Masukkan Nama untuk Menyimpan Skor:</h3>
        <input type="text" name="username" required>
        <button type="submit">SIMPAN POINT</button>
    </form>
    
    <a href="index.php">ULANGI</a>
</body>
</html>

<?php
// db_config.php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>