<?php
    session_start();

    if(!isset($_SESSION['user_id'])){
        header('location: login.php');

    }
   
    $current_page = basename($_SERVER['PHP_SELF']);

     // Include file koneksi database
     include_once('../config/config.php');

    
     if (isset($_GET['user_id'])) {
         $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
         
         // Eksekusi query
         $query = mysqli_query($conn, "SELECT * FROM users WHERE user_id = {$user_id}");
 
         if ($query && mysqli_num_rows($query) > 0) {
             $row = mysqli_fetch_assoc($query);
             $konsultan = $row['konsultan'];
             $user = $row['username'];
             $nav_item_class = ($konsultan === 'N' || $_SESSION['username'] === 'Anonymous') ? 'd-none' : '';
             $nav_style_class = ($konsultan === 'N' || $_SESSION['username'] === 'Anonymous') ? 'nav-margin-left' : 'nav-margin-right';           
         } else {
             $row = null;
             echo "User tidak ditemukan atau query gagal.";
         }
     } else {
         $row = null;
         echo "User ID tidak ditemukan di parameter URL.";
     }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lumiereapp</title>
    <link href="styles.css">
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
            font-family: 'Dancing Script', cursive; /* Font untuk teks utama */
            font-size: 45px; /* Ukuran font lebih besar */
            color: #7a73c7; !important; /* Warna utama */
            margin-left: 40px;
            
        }

        .navbar-tagline {
            font-family: 'Dancing Script', cursive; /* Font untuk tagline */
            font-size: 15px; /* Ukuran font tagline */
            color: #7a73c7;; /* Warna tagline */
            margin-top: -10px; /* Geser ke atas untuk dekat dengan teks utama */
            margin-bottom: 10px;
        }

        .navbar-nav .nav-link {
            color: white !important; /* Warna teks menu */
            font-size: 16px; /* Ukuran font menu */
            margin-right: 25px; /* Jarak antar menu */
            display: flex;
            align-items: center;
            border-radius: 50px;
        }

        .navbar-nav .nav-link:hover {
            background-color: #6c63ff; /* Warna tombol saat di-hover */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Tambahkan bayangan */
            transform: scale(1.05); /* Sedikit perbesar tombol */
        }

        .navbar-nav {
            flex-direction: row; /* Menjadikan menu horizontal */
            margin-left: 400px; /* Memberi jarak dari teks brand */
        }
        

        .navbar-nav .nav-link i {
            margin-right: 10px; /* Jarak antara ikon dan teks */
        }
        
        .navbar {
            background-color: #9370DB; /* Warna latar navbar */
        }

        /* Gaya umum untuk tombol logout */
        .cancel-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #7a73c7; /* Warna dasar tombol */
            color: white; /* Warna teks */
            font-size: 16px; /* Ukuran teks */
            border: none; /* Hilangkan border */
            border-radius: 50px; /* Membuat sudut melengkung */
            padding: 10px 20px; /* Ruang dalam tombol */
            cursor: pointer; /* Ubah kursor menjadi pointer */
            transition: all 0.3s ease; /* Animasi transisi */
            text-decoration: none; /* Hilangkan garis bawah */
        }

        /* Efek hover untuk tombol */
        .cancel-button:hover {
            background-color: #6c63ff; /* Warna tombol saat di-hover */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Tambahkan bayangan */
            transform: scale(1.05); /* Sedikit perbesar tombol */
        }

        /* Gaya ikon dalam tombol */
        .cancel-button i {
            margin-right: 8px; /* Jarak antara ikon dan teks */
            font-size: 18px; /* Ukuran ikon */
        }

        .active {
            font-weight: bold;
            color: #007BFF;
            font-size: 16px; /* Ukuran font menu */
            margin-right: 25px; /* Jarak antar menu */
            display: flex;
            align-items: center;
            border-radius: 50px;
            text-decoration: none; /* Hilangkan garis bawah */
            
        }
        .active i {
            margin-right: 10px; /* Jarak antara ikon dan teks */
        }

   

    

    .nav-margin-left {
    margin-left: 305px !important;
    }

    .nav-margin-right {
    margin-left: 40px !important;
    }

    /* Chat Container */
.chat-container {
    max-width: 800px;
    margin: auto;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    background-color:rgb(212, 204, 248);
    margin-bottom:20px;
}

.profile-header img {
    width: 50px;
    height: 50px;
    border-bottom: 1px solid #ddd;
    background-color:rgb(197, 187, 243);
}

.profile-header  {
    border-bottom: 2px solid #ddd;
    padding: 10px;
            display: flex;
}


.search-bar input {
    border-radius: 20px;
    border: 1px solid #ccc;
    padding: 8px 12px;
}

.chat-list {
    max-height: 300px;
    overflow-y: auto; /* Scroll tetap berfungsi */
    scrollbar-width: none; /* Firefox */
    -ms-overflow-style: none; /* Internet Explorer dan Edge */
}

/* Untuk Chrome, Safari, dan Opera */
.chat-list::-webkit-scrollbar {
    display: none; /* Hilangkan scrollbar */
}

.chat-item img {
    width: 40px;
    height: 40px;
}

.online-status i {
    font-size: 10px;
}

/* Hover Effect on Chat Items */
.chat-item:hover {
    background-color: #f8f9fa;
    cursor: pointer;
}

/* Gaya untuk tanda panah kembali */
.back-arrow {
    text-decoration: none;
    color: #333;
    font-size: 20px;
    transition: transform 0.3s ease;
}

.back-arrow:hover {
    color: #6c63ff;
    transform: scale(1.1);
}

.chat-box {
            padding: 10px;
            max-height: 400px;
            overflow-y: auto;
            overflow-y: auto; /* Scroll tetap berfungsi */
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* Internet Explorer dan Edge */
        }

        .message {
            display: flex;
            margin-bottom: 10px;
        }

        .message img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .message-content {
            background-color: #f0f0f0;
            padding: 8px 12px;
            border-radius: 15px;
            max-width: 75%;
            font-size: 14px;
        }

        .message-right {
            justify-content: flex-end;
        }

        .message-right .message-content {
            background-color: #6c63ff;
            color: white;
            border-bottom-right-radius: 0;
        }

        .message-left .message-content {
            border-bottom-left-radius: 0;
        }

        .footer-input {
            padding: 10px;
            display: flex;
            border-top: 1px solid #ddd;
        }

        .footer-input input {
            flex: 1;
            border: none;
            padding: 10px;
            border-radius: 20px;
            margin-right: 10px;
            outline: none;
        }

        .footer-input button {
            border: none;
            background-color: #6c63ff;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
        }

        .footer-input button i {
            font-size: 16px;
        }

      
        
    </style>
</head>
  <body class="container">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <header>
        <nav class="navbar navbar-expand-lg " style="background-color: #beb3ff; color: white;">
            <div class="container-fluid">
             
            <a href="../index.php" class="navbar-brand" >
                Lumière
                <div class="navbar-tagline">together, we find strength</div>
            </a>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav " >
                <li class="nav-item <?= $nav_item_class; ?>"><a class="nav-link "  style="color: white; "href="../index.php"><i class="fas fa-home"></i> Home</a></li>
                <li class="nav-item <?= $nav_item_class; ?>"><a class="nav-link "   style="color: white; "href="diary.php"><i class="fas fa-book"></i> Jurnal</a></li>
                <li class="nav-item <?= $nav_item_class; ?>"><a class="<?= $current_page == 'chat.php' ? 'active' : '' ?>" ><i class="fas fa-comments"></i> Chat</a></li>
               
                <!-- Dropdown Profil dan Logout -->
                <li class="nav-item dropdown <?= $nav_style_class; ?>">
                        <a class="nav-link dropdown-toggle cancel-button" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
        <div class="profile-header d-flex align-items-center mb-4">
            <!-- Tanda panah kembali -->
            <a href="javascript:history.back();" class="back-arrow me-2" title="Back">
                <i class="fas fa-arrow-left"></i>
            </a>
            <img src="../img/user.png" alt="User Avatar" class="rounded-circle me-2">
            <div>
                <h5 class="mb-0 fw-bold"><?php echo $row['display_name']?></h5>
                <span class="text-muted"><?php echo $row['status']?></span>
            </div>
        </div>

        <!-- Chat Box -->
        <div class="chat-box" id="messages">
            
        </div>

        <!-- Footer Input -->
        <form id="chat-form" class="footer-input">
            <!-- Input tersembunyi untuk outgoing_id -->
            <input type="hidden" id="outgoing_id" name="outgoing_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">

            <!-- Input tersembunyi untuk incoming_id -->
            <input type="hidden" id="incoming_id" name="incoming_id" value="<?php echo htmlspecialchars($_GET['user_id']); ?>">

            <!-- Input pesan -->
            <input type="text" id="message" name="message" class="input-field" placeholder="Type a message here..." required>
            <button type="submit"><i class="fas fa-paper-plane"></i></button>
        </form>

        <script >
          document.addEventListener('DOMContentLoaded', function () {
            const chatForm = document.getElementById('chat-form');
            const messagesContainer = document.getElementById('messages');
            let refreshInterval;

            // Submit form
            chatForm.addEventListener('submit', function (e) {
                e.preventDefault();

                const outgoing_id = document.getElementById('outgoing_id').value;
                const incoming_id = document.getElementById('incoming_id').value;
                const message = document.getElementById('message').value;

                if (message.trim() === "") {
                    alert("Message cannot be empty!");
                    return;
                }

                const xhr = new XMLHttpRequest();
                xhr.open("POST", "../php/insert-chat.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        console.log(xhr.responseText);
                        document.getElementById('message').value = ""; // Clear input
                        loadMessages(); // Reload messages
                    }
                };

                xhr.send(`outgoing_id=${outgoing_id}&incoming_id=${incoming_id}&message=${encodeURIComponent(message)}`);
            });

            // Function to load messages
            function loadMessages() {
                const incomingId = document.getElementById('incoming_id').value;

                const xhr = new XMLHttpRequest();
                xhr.open("GET", `../php/get-chat.php?incoming_id=${incomingId}`, true);

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const previousHeight = messagesContainer.scrollHeight; // Catat posisi sebelum update
                        messagesContainer.innerHTML = xhr.response;

                        // Jika tidak sedang scroll ke atas, lakukan scroll ke bawah otomatis
                        if (messagesContainer.scrollTop + messagesContainer.clientHeight >= previousHeight - 50) {
                            scrollToBottom();
                        }
                    }
                };

                xhr.send();
            }

            function scrollToBottom() {
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }

            // Logika untuk menghentikan refresh jika scroll ke atas
            function manageAutoRefresh() {
                const isAtBottom = messagesContainer.scrollTop + messagesContainer.clientHeight >= messagesContainer.scrollHeight - 50;

                if (isAtBottom) {
                    if (!refreshInterval) {
                        refreshInterval = setInterval(loadMessages, 500); // Aktifkan refresh
                    }
                } else {
                    clearInterval(refreshInterval); // Hentikan refresh jika scroll ke atas
                    refreshInterval = null;
                }
            }

            messagesContainer.addEventListener('scroll', manageAutoRefresh);

            // Initial load
            loadMessages();
            refreshInterval = setInterval(loadMessages, 500); // Aktifkan auto-refresh
        });

        </script>
        
    
    </div>
    
    
        <footer class="bg_light ">
        <div class="text-center p-3" style="background:#ccc;">
            Copyright &copy; 2024
        </div>
    </footer>

</body>


</html>

        
    