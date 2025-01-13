<?php
    session_start();
    include_once('../config/config.php');

    $outgoing_id = $_SESSION['user_id'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    $sql = "SELECT DISTINCT u.*
                FROM users u
                WHERE u.user_id IN (
                    SELECT m.outgoing_msg_id
                    FROM messages m
                    WHERE m.incoming_msg_id = {$outgoing_id}
                )
                and u.konsultan='N' AND (u.username LIKE '%{$searchTerm}%')
                ORDER BY u.user_id ASC;";
    $output = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        include "data_konsultan.php";
    }else{
        $output .= 'Nama user tidak ditemukan!';
    }
    echo $output;
    
?>