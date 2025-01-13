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

        .calendar {
      display: grid;
      grid-template-columns: repeat(7, 1fr); /* 7 kolom untuk setiap hari dalam seminggu */
      gap: 8px; /* Spasi antar elemen */
      padding: 10px;
  }

  .day {
      background-color: #f4f4f4;
      border: 1px solid #ddd;
      border-radius: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      padding: 10px;
      cursor: pointer;
  }

  .day.mood {
      font-weight: bold;
      color: #fff;
      background-color: #007bff; /* Warna mood */
  }

  /* Media Queries untuk layar kecil */
  @media (max-width: 768px) {
      .calendar {
          grid-template-columns: repeat(8, 1fr); /* Tampilkan 3 kolom pada layar kecil */
          gap: 4px;
      }

      .day {
          font-size: 14px;
          padding: 8px;
      }
  }

  @media (max-width: 480px) {
      .calendar {
          grid-template-columns: repeat(5, 1fr); /* Tampilkan 2 kolom pada layar lebih kecil */
      }

      .day {
          font-size: 12px;
          padding: 6px;
      }
  }

  .nav-link2 {
    display: block;
    text-align: center; /* Pusatkan teks di dalam tombol */
    margin: 20px auto; /* Atur margin otomatis untuk horizontal */
    width: fit-content; /* Sesuaikan lebar tombol dengan isi */
    padding: 10px 20px; /* Tambahkan padding agar tombol terlihat lebih baik */
    background-color: #7a73c7; /* Warna latar belakang tombol */
    color: white; /* Warna teks */
    border-radius: 5px; /* Rounding sudut tombol */
    text-decoration: none; /* Hilangkan garis bawah */
}

.nav-link2:hover {
    background-color: #5e58a7; /* Warna saat di-hover */
    color: white; /* Warna teks tetap putih saat hover */
}


       
       

    </style>
</head>
  <body class="container">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <header>
        <nav class="navbar navbar-expand-lg" style="background-color: #beb3ff; color: white;">
            <div class="container">
                <!-- Logo Navbar -->
                <a href="../index.php" class="navbar-brand" >
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
                    <li class="nav-item "><a class="<?= $current_page == 'show_diary.php' ? 'active' : '' ?>"  ><i class="fas fa-book"></i> Jurnal</a></li>
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
        

        <!-- Monthly Overview -->
        <div id="monthly-overview">
            <h3 class=>View Jurnal</h3>
            <div class="calendar" id="calendar"></div>
        </div>

        <!-- Modal for Viewing and Editing Notes -->
<div class="modal" id="note-modal">
    <div class="modal-content">
        <span class="close-btn" id="close-modal">&times;</span>
        <h3 id="modal-date"></h3>
        <p id="modal-mood"></p>
        <h4>Catatan:</h4>
        <p id="modal-title"></p>
        <p id="modal-note"></p>

        
    </div>
</div>

        <!-- Navigation Back to Mood Tracker -->
        <div class="navigation">
            <a href="diary.php" class="nav-link2">Kembali ke Tracker</a>
        </div>
    </div>
    
        <footer class="bg_light ">
        <div class="text-center p-3" style="background:#ccc;">
            Copyright &copy; 2024
        </div>
    </footer>

</body>

<script >
         // Show the note for a selected date
        function showNote(date) {
            const noteContent = document.getElementById('note-content');
            noteContent.innerHTML = `
                <p><strong>Tanggal:</strong> ${date}</p>
                <p><strong>Catatan:</strong> ${notes[date] || 'Tidak ada catatan untuk hari ini.'}</p>
            `;
            document.getElementById('calendar-view').style.display = 'none';
            document.getElementById('note-view').style.display = 'block';
        }

        // Go back to the calendar view
        function goBack() {
            document.getElementById('calendar-view').style.display = 'block';
            document.getElementById('note-view').style.display = 'none';
        }

       // Show/hide the note form
        function showNoteForm() {
            const form = document.getElementById('note-form');
            form.style.display = form.style.display === 'flex' ? 'none' : 'flex';
        }



        // Load calendar for monthly overview
        function loadMonthlyOverview() {
            const storedData = JSON.parse(localStorage.getItem('moods')) || [];
            const calendar = document.getElementById('calendar');
            const daysInMonth = new Date(new Date().getFullYear(), new Date().getMonth() , 0).getDate();

            calendar.innerHTML = '';
            for (let i = 1; i <= daysInMonth; i++) {
                const date = new Date();
                date.setDate(i);
                const dateString = date.toISOString().split('T')[0];

                const moodData = storedData.find(data => data.date === dateString);
                const dayElement = document.createElement('div');
                dayElement.classList.add('day');
                dayElement.textContent = i;

                if (moodData) {
                    dayElement.classList.add('mood');
                    dayElement.textContent = moodData.mood; // Menampilkan emoji langsung
                    dayElement.dataset.date = dateString;
                }

                dayElement.addEventListener('click', () => showNoteModal(dateString, moodData));
                calendar.appendChild(dayElement);
            }
        }

        function showNoteModal(date) {
            const modal = document.getElementById('note-modal');
            const modalDate = document.getElementById('modal-date');
            const modalMood = document.getElementById('modal-mood');
            const modalTitle = document.getElementById('modal-title');
            const modalNote = document.getElementById('modal-note');

            // Set tanggal di modal
            modalDate.textContent = `Tanggal: ${date}`;
            modal.style.display = 'flex'; // Tampilkan modal

            // Ambil data dari backend
            fetch(`../php/get_mood.php?date=${date}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const moodData = data.data;

                        // Menampilkan emoji mood langsung
                        modalMood.textContent = `Mood: ${moodData.mood || "Tidak tersedia"}`;

                        // Tampilkan judul catatan
                        modalTitle.textContent = moodData.title || "Tidak ada judul";

                        // Tampilkan isi catatan
                        modalNote.textContent = moodData.content || "Tidak ada catatan.";
                    } else {
                        // Jika tidak ada data untuk tanggal ini
                        modalMood.textContent = "Mood: Tidak tersedia";
                        modalTitle.textContent = "Tidak ada judul";
                        modalNote.textContent = "Tidak ada catatan untuk tanggal ini.";
                    }
                })
                .catch(error => {
                    console.error('Error:', error);

                    // Jika terjadi error saat pengambilan data
                    modalMood.textContent = "Mood: Gagal memuat data.";
                    modalTitle.textContent = "Tidak ada judul";
                    modalNote.textContent = "Terjadi kesalahan saat memuat catatan.";
                });
        }

        // Tutup modal saat tombol "X" ditekan
        document.getElementById('close-modal').addEventListener('click', () => {
            document.getElementById('note-modal').style.display = 'none';
        });



        // Initialize the calendar on monthly overview page
        if (document.getElementById('calendar')) {
            document.addEventListener('DOMContentLoaded', loadMonthlyOverview);
        }
        function saveMoods() {
            localStorage.setItem('dailyMoods', JSON.stringify(dailyMoods));
        }

        function loadMoods() {
            const savedMoods = localStorage.getItem('dailyMoods');
            if (savedMoods) {
                Object.assign(dailyMoods, JSON.parse(savedMoods));
            }
        }

        if (dailyMoods[date]) {
            day.innerHTML = `<img src="${moodIcons[dailyMoods[date]]}" alt="${dailyMoods[date]}" class="mood-icon">`;
        }

        const moodIcons = {
            "😔": "sad.png",
            "😕": "stress.png",
            "😐": "meh.png",
            "🙂": "happy.png",
            "😄": "peaceful.png",
            "😡": "angry.png",
            "😟":"confused.png",
        };


    </script>

</html>

        
    