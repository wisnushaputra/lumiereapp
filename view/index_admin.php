<?php
    session_start();
    include_once('../config/config.php');
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
    <link rel="stylesheet" href="../css/signin.css">
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

   
    <div class="col-sm-2 ms-auto d-flex justify-content-between align-items-center">
        <!-- Tombol Add -->
        
        <button type="button" style="background-color:#968fe8; color:white;" class="btn  mb-2 me-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Daftarkan Listener
        </button>

        
    </div>

    <div class="container mt-5">
        <h3 class="mb-4 text-rignt">Daftar User</h3>
        
        <!-- Form Search -->
        <form method="get" class="d-flex mb-3 mt-2">
            <input class="form-control me-2" type="search" name="search" placeholder="Cari user..." value="<?= htmlspecialchars($search_query); ?>">
            <button class="btn " style="background-color:#968fe8; color:white;" type="submit">Search</button>
        </form>

        <!-- Tabel -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Pagination settings
                    $limit = 5; // Jumlah data per halaman
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $offset = ($page - 1) * $limit;

                    // Search query
                    $search_query = isset($_GET['search']) ? trim($_GET['search']) : "";

                    // Query for counting total rows
                    $count_query = "SELECT COUNT(*) AS total FROM users WHERE konsultan = 'N' and not username = 'admin'";
                    if (!empty($search_query)) {
                        $count_query .= " AND (username LIKE '%$search_query%' OR display_name LIKE '%$search_query%')";
                    }
                    $count_result = mysqli_query($conn, $count_query);
                    $total_rows = mysqli_fetch_assoc($count_result)['total'];

                    // Query for fetching data with limit and offset
                    $query = "SELECT * FROM users WHERE konsultan = 'N' and not username = 'admin'";
                    if (!empty($search_query)) {
                        $query .= " AND (username LIKE '%$search_query%' OR display_name LIKE '%$search_query%')";
                    }
                    $query .= " LIMIT $limit OFFSET $offset";

                    $result = mysqli_query($conn, $query);
                    $no = $offset + 1; // Nomor urut

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <th scope='row'>{$no}</th>
                                <td>" . htmlspecialchars($row['username']) . "</td>
                                <td>" . htmlspecialchars($row['display_name']) . "</td>
                                <td>" . htmlspecialchars($row['email']) . "</td>
                                <td>" . htmlspecialchars($row['status']) . "</td>
                                
                            </tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr>
                                <td colspan='6' class='text-center'>Tidak ada data</td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php
                $total_pages = ceil($total_rows / $limit);
                for ($i = 1; $i <= $total_pages; $i++) {
                    $active = ($i == $page) ? 'active' : '';
                    echo "<li class='page-item $active'><a class='page-link' style='background-color:#968fe8; color:white;' href='$current_page?page=$i&search=$search_query'>$i</a></li>";
                }
                ?>
            </ul>
        </nav>
    </div>


    <div class="container mt-5">
        <h3 class="mb-4 text-rignt">Daftar Listener</h3>
        
        <!-- Form Search -->
        <form method="get" class="d-flex mb-3 mt-2">
            <input class="form-control me-2" type="search" name="search" placeholder="Cari listener..." value="<?= htmlspecialchars($search_query); ?>">
            <button class="btn " style="background-color:#968fe8; color:white;" type="submit">Search</button>
        </form>

        <!-- Tabel -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-primary" >
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Username</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Pagination settings
                    $limit = 5; // Jumlah data per halaman
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $offset = ($page - 1) * $limit;

                    // Search query
                    $search_query = isset($_GET['search']) ? trim($_GET['search']) : "";

                    // Query for counting total rows
                    $count_query = "SELECT COUNT(*) AS total FROM users WHERE konsultan = 'Y'";
                    if (!empty($search_query)) {
                        $count_query .= " AND (username LIKE '%$search_query%' OR display_name LIKE '%$search_query%')";
                    }
                    $count_result = mysqli_query($conn, $count_query);
                    $total_rows = mysqli_fetch_assoc($count_result)['total'];

                    // Query for fetching data with limit and offset
                    $query = "SELECT * FROM users WHERE konsultan = 'Y'";
                    if (!empty($search_query)) {
                        $query .= " AND (username LIKE '%$search_query%' OR display_name LIKE '%$search_query%')";
                    }
                    $query .= " LIMIT $limit OFFSET $offset";

                    $result = mysqli_query($conn, $query);
                    $no = $offset + 1; // Nomor urut

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                <th scope='row'>{$no}</th>
                                <td>" . htmlspecialchars($row['username']) . "</td>
                                <td>" . htmlspecialchars($row['display_name']) . "</td>
                                <td>" . htmlspecialchars($row['email']) . "</td>
                                <td>" . htmlspecialchars($row['status']) . "</td>
                                
                            </tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr>
                                <td colspan='6' class='text-center'>Tidak ada data</td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php
                $total_pages = ceil($total_rows / $limit);
                for ($i = 1; $i <= $total_pages; $i++) {
                    $active = ($i == $page) ? 'active' : '';
                    echo "<li class='page-item $active'><a class='page-link' style='background-color:#968fe8; color:white;' href='$current_page?page=$i&search=$search_query'>$i</a></li>";
                }
                ?>
            </ul>
        </nav>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <!-- Form starts here -->
                <form class="form"  method="post">
                    <!-- Username Input -->
                    <div class="input-wrapper">
                        <input type="text" id="username" name="username" placeholder="username" class="input-field button-like" required />
                    </div>

                    <!-- Display Name Input -->
                    <div class="input-wrapper">
                        <input type="text" id="displayName" name="displayName" placeholder="Full name" class="input-field button-like" required />
                    </div>

                    <!-- Email Input -->
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" placeholder="email" class="input-field button-like" required />
                    </div>

                    <!-- Password Input with Eye Icon -->
                    <div class="input-wrapper" style="position: relative;">
                        <input type="password" id="password" name="password" placeholder="password" class="input-field button-like" required />
                        <!-- Eye icon placed inside the password field container -->
                        <i class="far fa-eye" id="togglePassword" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                    </div>

                    <!-- Submit Button -->
                    <div class="button-wrapper" style="position: relative;">
                        <!-- Tombol Sign Up untuk mengirim formulir -->
                        <button type="submit" class="button-field">Save</button>
                        <br><br>
                        <!-- Tombol Cancel untuk membatalkan -->
                        <button type="button" id="cancel-button" style="border-radius:50px;" data-bs-dismiss="modal">Cancel</button>
                    
                    </div>
                </form>

            </div>
            
        </div>
    </div>
</div>

<?php

if(isset($_POST['username'])){
    $username = $_POST['username'];
    $display_name = $_POST['displayName'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if (strtolower($username) === "admin") {
        echo '<script>alert("Username tidak boleh menggunakan nama \'admin\'.");</script>';
    } else{
        $query = mysqli_query($conn, "INSERT INTO users (username, display_name, email, password,status,konsultan) values('$username','$display_name','$email','$password','Offline now','Y') ");

        if($query){
        
            echo '<script>alert("Selamat pendaftaran anda berhasil.");
            location.href = "index_admin.php";</script>';
        }else{
            echo '<script>alert("Pendaftaran gagal.");</script>';
        }
    }

    
    
}


?>
   
    <main>
       

        <footer class="bg_light ">
        <div class="text-center p-3" style="background:#ccc;">
            Copyright &copy; 2024
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const togglePassword = document.getElementById("togglePassword");
            const passwordField = document.getElementById("password");

            togglePassword.addEventListener("click", function () {
            // Toggle the type attribute of the password field
            const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);

            // Toggle the eye icon
            this.classList.toggle("fa-eye");
            this.classList.toggle("fa-eye-slash");
            });
        });
    </script>

</body>


</html>

        
    