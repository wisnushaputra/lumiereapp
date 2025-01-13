<?php

session_start();
include_once('../config/config.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lumière</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <!-- Include Font Awesome for the eye icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
</head>
<body>

    <?php

        if(isset($_POST['username'])){
            $username = $_POST['username'];
            $display_name = $_POST['displayName'];
            $password = $_POST['password'];
            $email = $_POST['email'];

            if (strtolower($username) === "admin") {
                echo '<script>alert("Username tidak boleh menggunakan nama \'admin\'.");</script>';
            } else{
                $query = mysqli_query($conn, "INSERT INTO users (username, display_name, email, password,status,konsultan) values('$username','$display_name','$email','$password','Offline now','N') ");

                if($query){
                
                    echo '<script>alert("Selamat pendaftaran anda berhasil.");
                    location.href = "login.php";</script>';
                }else{
                    echo '<script>alert("Pendaftaran gagal.");</script>';
                }
            }

            
            
        }
        

    ?>
    
    <div class="container">
        <h1 class="sign" style="text-align: center;">Welcome</h1>
        <h1 class="sign" style="text-align: center;">To</h1>
        <h1 class="logo">Lumière</h1>
        <p class="tagline">together, we find strength</p>

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
                <button type="submit" class="button-field">Sign Up</button>
                <br><br>
                <!-- Tombol Cancel untuk membatalkan -->
                <button type="button" id="cancel-button"><a href="login.php">Cancel</a></button>
               
            </div>
        </form>
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
    </script>
    
</body>
</html>


