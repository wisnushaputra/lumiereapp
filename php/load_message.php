<?php
session_start();
include_once('../config/config.php');

if (isset($_GET['incoming_id'])) {
    $incoming_id = mysqli_real_escape_string($conn, $_GET['incoming_id']);
    $outgoing_id = $_SESSION['user_id'];

    // Query untuk mengambil pesan
    $query = "SELECT * FROM messages 
              WHERE (outgoing_id = '$outgoing_id' AND incoming_id = '$incoming_id') 
                 OR (outgoing_id = '$incoming_id' AND incoming_id = '$outgoing_id') 
              ORDER BY created_at ASC";

    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['outgoing_id'] == $outgoing_id) {
            // Pesan dari pengguna (kanan)
            echo '<div class="message message-right">
                    <div class="message-content">' . htmlspecialchars($row['message']) . '</div>
                  </div>';
        } else {
            // Pesan dari lawan chat (kiri)
            echo '<div class="message message-left">
                    <img src="../img/user.png" alt="User">
                    <div class="message-content">' . htmlspecialchars($row['message']) . '</div>
                  </div>';
        }
    }
} else {
    echo "Tidak ada pesan.";
}
?>
