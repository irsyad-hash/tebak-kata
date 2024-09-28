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
    $results = [];

    for ($i = 0; $i < $wordLength; $i++) {
        if ($userInput[$i] === $wordToGuess[$i]) {
            $score += 10;
            $correctCount++;
            $results[$i] = ['letter' => $userInput[$i], 'class' => 'correct', 'points' => 10];
        } elseif ($i === 2 || $i === 6) {
            $results[$i] = ['letter' => $wordToGuess[$i], 'class' => 'clue', 'points' => 0];
        } else {
            $score -= 2;
            $results[$i] = ['letter' => $userInput[$i], 'class' => 'incorrect', 'points' => -2];
        }
    }

    $_SESSION['score'] = $score;
    $_SESSION['word'] = $wordToGuess;
    $_SESSION['results'] = $results;

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
    <div class="container">
        <h1>Permainan Tebak Kata</h1>
        <p class="question"><?php echo $question; ?></p>
        <form method="POST">
            <div class="word-input">
                <?php for ($i = 0; $i < $wordLength; $i++): ?>
                    <?php if ($i === 2 || $i === 6): ?>
                        <input type="text" name="letters[]" value="<?php echo $wordToGuess[$i]; ?>" readonly class="letter-input clue">
                    <?php else: ?>
                        <input type="text" name="letters[]" maxlength="1" required class="letter-input">
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
            <button type="submit" class="submit-btn">Jawab</button>
        </form>
    </div>
</body>
</html>