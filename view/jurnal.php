<?php
    session_start();
    include_once('../config/config.php');
    if(!isset($_SESSION['user_id'])){
        header('location: login.php');

    }

    $current_page = basename($_SERVER['PHP_SELF']);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diary Feature</title>
    <link href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

       
       
        main {
            padding: 20px;
            max-width: 800px;
            margin: auto;
        }

        h1, h2 {
            margin-bottom: 10px;
        }

        /* Form styles */
        form {
            background-color: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin: 10px 0 5px;
        }

        form input, form textarea, form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        form button {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form button:hover {
            background-color: #0056b3;
        }

        /* Diary entries */
        #entries-container {
            margin-top: 20px;
        }

        .entry {
            background-color: #fff;
            margin-bottom: 15px;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .entry h3 {
            margin-top: 0;
        }

        .entry .date {
            display: block;
            margin-top: 10px;
            font-size: 14px;
            color: #666;
        }


        button[type="submit"] {
            background-color: #9370DB;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            cursor: pointer;
            width: 50%;
            transition: background-color 0.3s;
            
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .btn-cancel {
            background-color: #9370DB;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            cursor: pointer;
            width: 50%;
            transition: background-color 0.3s;
            text-decoration: none; /* Hilangkan garis bawah */
            margin-bottom:15px;
            text-align:center;
        }

        .btn-cancel:hover {
            background-color: #0056b3;
        }


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

        .dropdown{
        margin-left:70px;
    }

    </style>
</head>
<body class="container" >
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
                <li class="nav-item"><a class="nav-link "  style="color: white; "href="../index.php"><i class="fas fa-home"></i> Home</a></li>
                <li class="nav-item "><a class="<?= $current_page == 'jurnal.php' ? 'active' : '' ?>"  ><i class="fas fa-book"></i> Jurnal</a></li>
                <li class="nav-item"><a class="nav-link "  style="color: white; " href="#"><i class="fas fa-comments"></i> Chat</a></li>
                 <!-- Dropdown Profil dan Logout -->
                 <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle cancel-button" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> <?= htmlspecialchars($_SESSION['username']); ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <!-- <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user-circle"></i> Profile</a></li> -->
                            <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                        </ul>
                    </li>
                    
                </ul>               
                    
                </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section id="add-entry">
            <h2>Add New Jurnal</h2>
            <form method="POST">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>

                <label for="content">Content:</label>
                <textarea id="content" name="content" rows="10" required></textarea>

                <div class="button-wrapper">
                    <!-- Tombol Kirim -->
                    <button  type="submit" name="submit">Kirim</button>
                    
                    <!-- Tombol Cancel -->
                    <a href="diary.php" class="btn-cancel">Cancel</a>
                </div>
         
            </form>
        </section>

        <?php

       

        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $content = $_POST['content'];
        
            // Pastikan user_id disimpan di sesi
            $user_id = $_SESSION['user_id']; 
        
            // Gunakan prepared statement untuk keamanan
            $stmt = $conn->prepare("INSERT INTO diary_entries (title, content, user_id) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $title, $content, $user_id);
        
            if ($stmt->execute()) {
                echo '<script>alert("Add jurnal sukses!!"); location.href = "diary.php";</script>';
            } else {
                echo '<script>alert("Add jurnal gagal.");</script>';
            }
        
            $stmt->close();
        }
        

       
        

    ?>

       
    </main>

    <footer class="bg_light ">
        <div class="text-center p-3" style="background:#ccc;">
            Copyright &copy; 2024
        </div>
    </footer>
</body>
</html>
