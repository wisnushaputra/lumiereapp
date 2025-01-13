<?php
    session_start();
    include_once('../config/config.php');

    $outgoing_id = $_SESSION['user_id'];
    $searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

    $sql = "SELECT * FROM users WHERE NOT user_id = {$outgoing_id} and konsultan='Y' AND (username LIKE '%{$searchTerm}%') ";
    $output = "";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        include "data.php";
    }else{
        $output .= 'Nama user tidak ditemukan!';
    }
    echo $output;
    
?>