<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti sesuai username MySQL Anda
$password = ""; // Ganti sesuai password MySQL Anda
$dbname = "lumiere";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

?>