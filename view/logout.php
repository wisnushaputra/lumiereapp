<?php
session_start();
if (isset($_SESSION['user_id'])) {
    include_once('../config/config.php');
    
    // Ambil data user dari sesi
    $logout_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);
    $username = $_SESSION['username'];
    
    // Periksa apakah username adalah Anonymous
    if ($username == 'Anonymous') {
        // Hapus pengguna dari database
        $sql = mysqli_query($conn, "DELETE FROM users WHERE user_id = {$logout_id}");
        if ($sql) {
            // Hapus sesi dan redirect ke halaman login
            session_unset();
            session_destroy();
            echo '<script>alert("Selamat, anda telah logout :)");
                  location.href = "login.php";</script>';
        } else {
            echo '<script>alert("Terjadi kesalahan saat menghapus akun.");</script>';
        }
    } else {  
        // Jika bukan Anonymous, update status menjadi offline
        $status = "Offline now";
        $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE user_id = {$logout_id}");
        if ($sql) {
            // Hapus sesi dan redirect ke halaman login
            session_unset();
            session_destroy();
            echo '<script>alert("Selamat, anda telah logout :)");
                  location.href = "login.php";</script>';
        } else {
            echo '<script>alert("Terjadi kesalahan saat memperbarui status.");</script>';
        }
    }
} else {  
    // Jika sesi tidak ditemukan, arahkan ke halaman login
    header("location: login.php");
    exit;
}
?>
