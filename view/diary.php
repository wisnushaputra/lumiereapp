<?php
    session_start();
    include_once('../config/config.php');
    if(!isset($_SESSION['user_id'])){
        header('location: view/login.php');

    }

    $current_page = basename($_SERVER['PHP_SELF']);

    $query = mysqli_query($conn, "SELECT * FROM users where user_id = {$_SESSION['user_id']}");

    if(mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
    }else{
        echo "data tidak ada";
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="../css/styles_message.css">
    <link rel="stylesheet" href="../css/styles2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <style>
        .navbar-brand {
            font-weight: bold;
            font-size: 2em;
            font-family: 'Dancing Script', cursive;
            color: #7a73c7;  /* Warna utama */
            margin-left: 0.5em;
        }

        .navigation-container {
        display: flex; /* Menggunakan flexbox untuk tata letak */
        justify-content: center; /* Memusatkan secara horizontal */
        align-items: center; /* Memusatkan secara vertikal */
        height: 100px; /* Atur tinggi sesuai kebutuhan */
        margin-top: 20px; /* Tambahkan spasi atas jika diperlukan */
        }

        .nav-link2 {
            text-decoration: none; /* Menghilangkan garis bawah pada link */
            font-size: 1em; /* Atur ukuran font */
            padding: 10px 20px; /* Tambahkan padding */
            background-color: #968fe8; /* Warna latar belakang */
            color: white; /* Warna teks */
            border-radius: 8px; /* Membuat sudut membulat */
        }

      

    </style>
</head>
  <body class="container">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <header>
        <nav class="navbar navbar-expand-lg" style="background-color: #beb3ff; color: white;">
            <div class="container">
                <!-- Logo Navbar -->
                <a class="navbar-brand" >
                    Lumière
                    <div class="navbar-tagline" style="font-size: 0.5em; color: #7a73c7;">together, we find strength</div>
                </a>

                <!-- Button Toggle untuk Mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menu Navbar -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto"> <!-- Tambahkan ms-auto untuk menggeser ke kanan -->
                    <li class="nav-item"><a class="nav-link "  style="color: white; "href="../index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="nav-item "><a class="<?= $current_page == 'diary.php' ? 'active' : '' ?>"  ><i class="fas fa-book"></i> Jurnal</a></li>
                    <li class="nav-item"><a class="nav-link "  style="color: white; "href="message.php"><i class="fas fa-comments"></i> Chat</a></li>
                
                        <!-- Dropdown Profil dan Logout -->
                        

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user"></i> <?= htmlspecialchars($_SESSION['username']); ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <!-- <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user-circle"></i> Profile</a></li> -->
                                <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="chat-container mt-4 p-3">
       
      
                <!-- Daily Mood Tracker -->
        <div id="daily-mood">
            <p class="mood-prompt">Bagaimana perasaan anda hari ini?</p>
            <div class="mood-scale">
                <span class="mood" data-mood="😔"><img class="manImg" src="../dailyMood/sad.png"></img></span>
                <span class="mood" data-mood="😕"><img class="manImg" src="../dailyMood/stress.png"></img></span>
                <span class="mood" data-mood="😐"><img class="manImg" src="../dailyMood/meh.png"></img></span>
                <span class="mood" data-mood="🙂"><img class="manImg" src="../dailyMood/happy.png"></img></span>
                <span class="mood" data-mood="😄"><img class="manImg" src="../dailyMood/peaceful.png"></img></span>
                <span class="mood" data-mood="😡"><img class="manImg" src="../dailyMood/angry.png"></img></span>
                <span class="mood" data-mood="😟"><img class="manImg" src="../dailyMood/confused.png"></img></span>
            </div>
            <button class="add-note" onclick="showNoteForm()">Tambah Catatan</button>
        </div>

        <!-- Add Note Form -->
        <div class="note-form" id="note-form" >
            <input type="text" id="title" name="title" placeholder="Judul" />
            <textarea id="content" name="content" rows="10" placeholder="Catatan hari ini"></textarea>
            <button class="save-note"  onclick="saveMoodAndNote()">Simpan</button>
        </div>

        <!-- Navigation to Calendar -->
        <div class="navigation-container">
            <a href="show_diary.php" class="nav-link2 btn">Lihat Kalender</a>
        </div>
      
      
        
    </div>
    <script src="../users.js"></script>
    
    <footer class="bg_light ">
        <div class="text-center p-3" style="background:#ccc;">
            Copyright &copy; 2024
        </div>
    </footer>

    <script >
    // Show/hide the note form
        function showNoteForm() {
            const form = document.getElementById('note-form');
            form.style.display = form.style.display === 'flex' ? 'none' : 'flex';
        }



        // Save mood and note to localStorage
        function saveMoodAndNote() {
            const selectedMood = document.querySelector('.mood.selected')?.dataset.mood;
            const noteTitle = document.getElementById('title').value;
            const noteContent = document.getElementById('content').value;

            if (!selectedMood) {
                alert('Silakan pilih mood terlebih dahulu!');
                return;
            }

            const today = new Date().toISOString().split('T')[0];
            const moodData = {
                date: today,
                mood: selectedMood, // mood sekarang adalah teks seperti "sad", "happy", dll
                title: noteTitle,
                content: noteContent,
            };

            // Kirim data ke backend
            fetch('../php/save_mood.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(moodData),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        window.location.href = 'diary.php';
                    } else {
                        alert('Gagal menyimpan: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan data.');
                });

            // Reset form
            document.getElementById('title').value = '';
            document.getElementById('content').value = '';
        }

        // Highlight selected mood (diupdate untuk menggunakan nama mood)
        document.querySelectorAll('.mood').forEach(mood => {
        mood.addEventListener('click', () => {
            // Hapus kelas 'selected' dari semua mood
            document.querySelectorAll('.mood').forEach(m => m.classList.remove('selected'));

            // Tambahkan kelas 'selected' ke mood yang diklik
            mood.classList.add('selected');
        });
    });







        const moodIcons = {
            "sad": "sad.png",
            "stress": "stress.png",
            "meh": "meh.png",
            "happy": "happy.png",
            "peaceful": "peaceful.png",
            "angry": "angry.png",
            "confused": "confused.png",
        };

    </script>

</body>


</html>

        
    