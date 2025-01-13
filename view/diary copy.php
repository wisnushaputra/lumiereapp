<?php
    session_start();

    if(!isset($_SESSION['user_id'])){
        header('location: login.php');

    }
    
    // Inisialisasi variabel
    $search_query = isset($_GET['search']) ? trim($_GET['search']) : "";
    $search_date = isset($_GET['search_date']) ? trim($_GET['search_date']) : "";
    $filtered_results = [];

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

        .align-items-center {
            margin-top:10px;
        }
        .search {
            margin-top:15px;
        }
        
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            justify-content: center;
            margin: 20px;
        }

        .card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
            padding: 16px;
            text-align: center;
        }

        .card h3 {
            margin-top: 0;
            color: #333;
        }

        .card p {
            color: #555;
            margin: 10px 0;
        }

        .card .btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }

        .card .btn:hover {
            background-color: #0056b3;
        }


        .text-preview {
          overflow: hidden;
          display: -webkit-box;
          -webkit-line-clamp: 3; /* Batasi ke 3 baris */
          -webkit-box-orient: vertical;
          text-overflow: ellipsis;
          white-space: normal;
          max-height: 4.5em; /* Sesuaikan dengan tinggi 3 baris teks */
      }
     
      .btn-delete {
          padding: 2px 5px; /* Ukuran lebih kecil untuk "Delete" */
          font-size: 10px;   /* Font lebih kecil */
          
      }

      /* Styling untuk form agar input sejajar dengan label */
    .form-group {
        display: flex;
        align-items: center; /* Vertikal sejajar di tengah */
        margin-bottom: 15px; /* Spasi antar form group */
    }

    .form-group label {
        width: 100px; /* Lebar label */
        margin-right: 10px; /* Jarak antara label dan input */
        font-weight: bold;
    }

    .form-group input {
        flex: 1; /* Input akan mengambil sisa ruang */
    }

    .form-group button {
        margin-left: 10px; /* Jarak antara input dan tombol */
    }

    .btn-delete {
    margin-right: 5px; /* Beri jarak antara tombol Delete dan Update */
    }
    .d-flex {
        display: flex;
        gap: 5px; /* Tambahkan jarak antar elemen jika dibutuhkan */
    }

    </style>
</head>
  <body class="container" >
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

    <main>
    <div class="container mt-3">
        <div id="alert-container"></div>
    </div>

    
    <div class="mb-3 row align-items-center">
        
        
        <div class="col-sm-6 search">
            <form method="GET" action="">
                <!-- Tanggal -->
                <div class="form-group">
                    <label for="tanggal">Date</label>
                    <input type="date" name="search_date" class="form-control" id="tanggal" value="<?= htmlspecialchars($search_date ?? ''); ?>">
                </div>

                <!-- Searching -->
                <div class="form-group">
                    <label for="search">Searching</label>
                    <input type="text" name="search" class="form-control" id="search" placeholder="Search by title or content" value="<?= htmlspecialchars($search_query); ?>">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>

    
    </div>
    <div class="col-sm-2 ms-auto d-flex justify-content-between align-items-center">
        <!-- Tombol Add -->
        <button type="button" class="btn btn-primary mb-3 me-2">
            <a href="jurnal.php" style="color:white; text-decoration: none;">
                <i class="fas fa-plus"></i> Add
            </a>
        </button>

        <!-- Tombol Refresh -->
        <form method="GET" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <button type="submit" class="btn btn-primary mb-3">
                <i class="fas fa-sync-alt"></i> Refresh
            </button>
        </form>
    </div>

    
   
   
    <main>
       
    <section id="card-section">
            
            <div class="card-container">
                <?php
                // Include database connection
                include_once('../config/config.php');

                // Query dasar
               $query = "SELECT * FROM diary_entries WHERE user_id = ?";
               $params = [$_SESSION['user_id']];
               $types = "i";

                // Filter teks
                if (!empty($search_query)) {
                    $query .= " AND (title LIKE ? OR content LIKE ?)";
                    $like_query = "%" . $search_query . "%";
                    $params[] = $like_query;
                    $params[] = $like_query;
                    $types .= "ss";
                }
              
                // Filter tanggal
                if (!empty($search_date)) {
                   
                    if (preg_match("/^\d{4}-\d{2}-\d{2}$/", $search_date)) {
                        $query .= " AND DATE(created_at) = ?";
                        $params[] = $search_date;
                        $types .= "s";
                    } else {
                        echo "Invalid date format!";
                    }
                }

                // Siapkan statement
                $stmt = $conn->prepare($query);
                if (!empty($params)) {
                    $stmt->bind_param($types, ...$params);
                }

            
           
                // Eksekusi query
                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    $filtered_results = $result->fetch_all(MYSQLI_ASSOC);
                }

                if (!empty($filtered_results)) {
                    foreach ($filtered_results as $row) {
                        echo "<div class='card' style='width: 18rem;background-color:rgb(226, 223, 247);'>";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>" . htmlspecialchars($row['title']) . "</h5>";
                        echo "<p class='card-text text-preview'>" . htmlspecialchars($row['content']) . "</p>";
                        echo "<span class=' show-more' style='color:#0056b3; cursor: pointer;'>Selengkapnya...</span>";
                        echo "<br><br>";
                        echo "<div class='d-flex justify-content-between'>"; // Membuat tombol sejajar
                        // Form untuk Delete
                        echo "<form method='POST' onsubmit='return confirm(\"Yakin ingin menghapus data ini?\");' style='margin-right: 5px;'>";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                        echo "<button type='submit' style='background-color:#FF0000;color:white' class='btn btn-danger btn-delete'>Delete</button>";
                        echo "</form>";
                        // Form untuk Update
                        echo "<form method='GET' action='update_diary.php'>";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                        echo "<button type='submit' style='background-color:#0056b3;color:white' class='btn btn-delete'>Update</button>";
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    
                } else {
                    echo "<p>No results found.</p>";
                }


                // Periksa jika ID dikirim melalui POST
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
                    $id = intval($_POST['id']);
                    $query = "DELETE FROM diary_entries WHERE id = ? AND user_id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("ii", $id, $_SESSION['user_id']);
                    if ($stmt->execute()) {
                        echo "<script>alert('Data berhasil dihapus!'); window.location.href = 'diary.php';</script>";
                    } else {
                        echo "<script>alert('Gagal menghapus data.');</script>";
                    }
                }
                


                ?>
            </div>

            
        </section>

        <footer class="bg_light ">
        <div class="text-center p-3" style="background:#ccc;">
            Copyright &copy; 2024
        </div>
    </footer>

</body>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const buttons = document.querySelectorAll(".show-more");

        buttons.forEach(button => {
            button.addEventListener("click", function () {
                const text = this.previousElementSibling; // Deskripsi sebelum tombol
                if (text.classList.contains("text-preview")) {
                    text.classList.remove("text-preview");
                    this.textContent = "Tutup";
                } else {
                    text.classList.add("text-preview");
                    this.textContent = "Selengkapnya...";
                }
            });
        });
    });
</script>

</html>

        
    