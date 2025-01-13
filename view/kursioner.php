<?php
session_start();
include "koneksi.php";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $responses = $_POST['responses'];

    foreach ($responses as $question_id => $answer) {
        $query = "INSERT INTO responses (name, question_id, answer) VALUES ('$name', '$question_id', '$answer')";
        mysqli_query($conn, $query);
    }

    echo '<script>alert("Terima kasih telah mengisi kuisioner! Jawaban anda sudah kami simpan. Mohon untuk terus memantau email dari kami."); location.href="login.php";</script>';
}

$query = "SELECT * FROM questions";
$result = mysqli_query($conn, $query);
$questions = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lumière</title>
    <link rel="stylesheet" href="style_kursioner.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Silahkan Isi Kursioner di bawah ini:</h1>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <form method="post" action="">
            <div class="input-wrapper">
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name"   required>
            </div>
            <div class="input-wrapper">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email"   required>
            </div>

            <?php foreach ($questions as $question): ?>
                <div class="question">
                    <p><strong><?php echo $question['id'] . '. ' . $question['question_text']; ?></strong></p>
                    <?php
                    $options = explode(',', $question['options']);
                    foreach ($options as $option): ?>
                        <div>
                            <input type="radio" name="responses[<?php echo $question['id']; ?>]" value="<?php echo $option; ?>" required>
                            <label><?php echo $option; ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <div class="button-wrapper">
                <!-- Tombol Kirim -->
                <button type="submit" name="submit">Kirim</button>
                
                <!-- Tombol Cancel -->
                <button type="button" >
                    <a href="login.php">Cancel</a>
                </button>
            </div>
        </form>
    </div>
</body>
</html>
