<?php
// Kata yang benar
$correctWord = "LEMARI";
$score = 0;

// Mengambil input dari form
$huruf1 = strtoupper($_POST['huruf1']);
$huruf2 = strtoupper($_POST['huruf2']);
$huruf4 = strtoupper($_POST['huruf4']);
$huruf5 = strtoupper($_POST['huruf5']);
$huruf6 = strtoupper($_POST['huruf6']);

// Huruf yang dimasukkan pengguna
$inputs = [$huruf1, $huruf2, 'M', $huruf4, $huruf5, $huruf6, 'R'];

// Menghitung skor
for ($i = 0; $i < count($inputs); $i++) {
    if ($i === 2 || $i === 6) continue; // Abaikan huruf ke-3 dan ke-7 (clue)
    if ($inputs[$i] === $correctWord[$i]) {
        $score += 10; // Tambah 10 jika benar
    } else {
        $score -= 2; // Kurangi 2 jika salah
    }
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
        <p>Skor yang Anda dapatkan adalah: <strong><?php echo $score; ?></strong></p>

        <form action="save_score.php" method="POST">
            <input type="hidden" name="score" value="<?php echo $score; ?>">
            <label for="name">Masukkan Nama Anda:</label>
            <input type="text" id="name" name="name" required>
            <button type="submit">Simpan Skor</button>
        </form>

        <form action="index.php" method="GET">
            <button type="submit">Ulangi Permainan</button>
        </form>
    </div>
</body>
</html>
