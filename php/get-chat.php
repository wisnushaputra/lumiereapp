
<?php
session_start();
include_once('../config/config.php');

if (isset($_GET['incoming_id'])) {
    $incoming_id = mysqli_real_escape_string($conn, $_GET['incoming_id']);
    $outgoing_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);

    // Query untuk mendapatkan pesan
    $query = "SELECT * FROM messages LEFT JOIN users ON users.user_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Render pesan
            if($row['outgoing_msg_id'] === $outgoing_id){
            echo '<div class="message message-right">
                                    <div class="message-content">'. htmlspecialchars($row['msg']) . '</div>
                                </div>';
            }else{
                echo '<div class="message message-left">
                                <img src="../img/user.png" alt="User">
                                <div class="message-content">'. htmlspecialchars($row['msg']) .'</div>
                            </div>';
            }
        }
    } else {
        echo "<div class='message'>No messages found.</div>";
    }
} else {
    echo "Incoming ID not found!";
}
?>
