<?php
    session_start();
    include_once('../config/config.php');
    $outgoing_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM users WHERE NOT user_id = {$outgoing_id} and konsultan = 'Y' ORDER BY user_id DESC";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include "data.php";
    }
    echo $output;
?>