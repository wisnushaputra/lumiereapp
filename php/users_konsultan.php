<?php
    session_start();
    include_once('../config/config.php');
    $outgoing_id = $_SESSION['user_id'];
    $sql = "SELECT DISTINCT u.*
                FROM users u
                WHERE u.user_id IN (
                    SELECT m.outgoing_msg_id
                    FROM messages m
                    WHERE m.incoming_msg_id = {$outgoing_id}
                )
                ORDER BY u.user_id ASC;";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include "data_konsultan.php";
    }
    echo $output;
?>