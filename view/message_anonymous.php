<?php
    session_start();

    if(!isset($_SESSION['user_id'])){
        header('location: login.php');

    }
   
    $current_page = basename($_SERVER['PHP_SELF']);


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lumiereapp</title>
    <link href="styles.css">
    <link rel="stylesheet" href="../css/styles_message.css">
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
    <?php

    include_once('../config/config.php');

            $query = mysqli_query($conn, "SELECT * FROM users where user_id = {$_SESSION['user_id']}");

            if(mysqli_num_rows($query) > 0){
                $row = mysqli_fetch_assoc($query);
            }else{
                echo "data tidak ada";
            }

    ?>
    <div class="chat-container mt-4 p-3">
        <div class="profile-header d-flex align-items-center mb-4">
            
            <img src="../img/user.png" alt="User Avatar" class="rounded-circle me-2">
            <div>
                <h5 class="mb-0 fw-bold"><?php echo $row['display_name']?></h5>
                <span class="text-muted"><?php echo $row['status']?></span>
            </div>
            
        </div>
        <div class="search-bar mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Enter name to search" >
                <!-- <button class="btn " style="background-color:#7a73c7; color:white;" type="button">
                    <i class="fas fa-search"></i> Search
                </button> -->
            </div>
        </div>
        <!-- Chat List -->
        <div class="chat-list">
        
        </div>
        
    </div>
<script src="../javascript/users.js"></script>
    
        <footer class="bg_light ">
        <div class="text-center p-3" style="background:#ccc;">
            Copyright &copy; 2024
        </div>
    </footer>

</body>


</html>

        
    