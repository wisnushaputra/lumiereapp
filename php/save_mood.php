<?php
session_start();
include_once('../config/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil input JSON dari request
    $input = json_decode(file_get_contents('php://input'), true);

    // Ambil data dari sesi dan input
    $user_id = $_SESSION['user_id'] ?? null;
    $date = date("Y-m-d");
    $mood = $input['mood'] ?? null;
    $title = $input['title'] ?? null;
    $content = $input['content'] ?? null;

    // Validasi data
    if (!$user_id || !$date || !$mood || !$title || !$content) {
        echo json_encode(['success' => false, 'message' => 'Data tidak lengkap!']);
        exit;
    }

    // Debug data untuk memastikan input diterima
    error_log("User ID: $user_id, Date: $date, Title: $title, Content: $content, Mood: $mood");

    // Periksa apakah tanggal sudah ada untuk user ini
    $checkQuery = "SELECT COUNT(*) FROM diary_entries WHERE user_id = ? AND created_at = ?";
    if ($checkStmt = $conn->prepare($checkQuery)) {
        $checkStmt->bind_param("is", $user_id, $date);
        $checkStmt->execute();
        $checkStmt->bind_result($count);
        $checkStmt->fetch();
        $checkStmt->close();

        if ($count > 0) {
            echo json_encode(['success' => false, 'message' => 'Jurnal untuk tanggal ini sudah ada!']);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal memeriksa data: ' . $conn->error]);
        exit;
    }

    // Query untuk menyimpan data ke database
    if ($stmt = $conn->prepare("INSERT INTO diary_entries (user_id, created_at, title, content, mood) VALUES (?, ?, ?, ?, ?)")) {
        // Menggunakan tipe data yang sesuai
        $stmt->bind_param("issss", $user_id, $date, $title, $content, $mood);

        // Eksekusi query dan cek hasilnya
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Jurnal berhasil disimpan!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menyimpan jurnal: ' . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal menyiapkan query: ' . $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Metode tidak valid!']);
}
?>
