<?php
session_start();
include_once('../config/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['date'],$_SESSION['user_id'])) {
    $date = $_GET['date'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT title, content, mood FROM diary_entries WHERE created_at = ? AND user_id = ?");
    $stmt->bind_param('s', $date);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode(['success' => true, 'data' => $data]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No data found for the selected date.']);
    }

    $stmt->close();
    $conn->close();
}
?>
