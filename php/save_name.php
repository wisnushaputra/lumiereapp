<?php
session_start();
include_once('../config/config.php'); // Pastikan koneksi database sudah benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['username']);

    // Jika nama kosong, beri nama default "Anonymous"
    if (empty($name)) {
        $name = 'Anonymous';
    }

    // Masukkan nama ke database
    $query = "INSERT INTO users (username, display_name, status, konsultan) VALUES ('$name','$name', 'Active now', 'N')";
    if (mysqli_query($conn, $query)) {
        // Ambil ID pengguna yang baru saja dibuat
        $user_id = mysqli_insert_id($conn);

        // Simpan nama dan user_id di sesi
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $name;

        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to save name.']);
    }
    exit;
}
?>
