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
        <p>Pertanyaan: Aku tempat menyimpan pakaian?</p>
        
        <form action="result.php" method="POST">
            <div class="input-container">
                <input type="text" maxlength="1" name="huruf1" required>
                <input type="text" maxlength="1" name="huruf2" required>
                <input type="text" maxlength="1" value="M" disabled> <!-- Huruf Clue ke-3 -->
                <input type="text" maxlength="1" name="huruf4" required>
                <input type="text" maxlength="1" name="huruf5" required>
                <input type="text" maxlength="1" name="huruf6" required>
                <input type="text" maxlength="1" value="R" disabled> <!-- Huruf Clue ke-7 -->
            </div>
            <button type="submit">Jawab</button>
        </form>
    </div>
</body>
</html>
