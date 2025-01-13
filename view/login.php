<?php

session_start();
include_once('../config/config.php');



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lumière</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">

</head>
<body>

    <?php

        if(isset($_POST['username'])){
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = mysqli_query($conn, "SELECT * FROM users where username = '$username' and password = '$password' ");

            if(mysqli_num_rows($query) > 0){
                $row = mysqli_fetch_assoc($query);
                    $status = "Active now";
                    $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE user_id = {$row['user_id']}");
                    if($sql2){

                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['status'] = $row['status'];
                        $_SESSION['display_name'] = $row['display_name'];
                        $konsultan = $row['konsultan'];
                        if($konsultan == 'N'){
                            if(strtolower($username) === "admin"){
                                echo '<script>alert("Selamat Datang, '.$row['username'].'");
                                location.href = "index_admin.php";</script>';
                            }else{
                                echo '<script>alert("Selamat Datang, '.$row['username'].'");
                                location.href = "../index.php";</script>';
                            }
                            
                        }else{
                            echo '<script>alert("Selamat Datang, '.$row['username'].'");
                            location.href = "message_konsultan.php";</script>';
                        }
                    }else{
                        echo '<script>alert("Username/Password tidak sesuai");</script>';
                    }
                
            }else{
                echo '<script>alert("Username/Password tidak sesuai");</script>';
            }

            
        }

    ?>

<div class="container">
        
        <h1 class="logo">Lumière</h1>
        <p class="tagline">together, we find strength</p>
        <!-- Include Font Awesome for the eye icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Form starts here -->
    <form method="post">
        <div class="form" >
            <!-- Username Button-like Input -->
            <div class="input-wrapper">
                <input type="text" id="username" name="username" placeholder="username" class="input-field button-like"  />
            </div>

            <!-- Password Button-like Input with Eye Icon -->
            <div class="input-wrapper" style="position: relative;">
                <input type="password" id="password" name="password" placeholder="password" class="input-field button-like"  />
                <!-- Eye icon placed inside the password field container -->
                <i class="far fa-eye" id="togglePassword" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
            </div>

            <div class="input-wrapper" style="position: relative;">
            
                <button type="submit"  class="button-field button-like">Login</button>
            </div>
          
        </div>
        
    </form>

    <!-- Already a user section -->
    <div class="already-user">
        <p>already a user? <!-- Updated links for stay anonymous and sign in -->
            <a href="sign_in.php">Sign In Here</a> or
            <a href="" id="anonymousButton">Stay Anonymous</a> </p>
    </div>

    <div class="already-user" >
        
            <a href="https://forms.gle/qmnKhrjLzAgwn1tJ9">Do you want to be a supporter?</a> 
    </div>
</div>

<div class="footer" class="bg_light">
    <p>what is an anonymous button?</p>
    <p>Get help instantly, no personal information required.</p>
   
</div>
      
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

        document.addEventListener("DOMContentLoaded", function () {
            // Event handler untuk tombol "Continue as Anonymous"
            document.getElementById('anonymousButton').addEventListener('click', function () {
                const anonymousName = 'Anonymous'; // Default name for anonymous users

                // Kirim data anonymous ke server
                fetch('../php/save_name.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `username=${encodeURIComponent(anonymousName)}`
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            // Simpan nama "Anonymous" di sessionStorage
                            sessionStorage.setItem('username', anonymousName);
                           
                            // Redirect ke halaman utama atau dashboard
                            window.location.href = 'message_anonymous.php'; // Ganti dengan halaman tujuan
                        } else {
                            alert(data.message || 'An error occurred.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to continue as anonymous. Please try again.');
                    });
            });
       
        });
    </script>
   
</body>
</html>
