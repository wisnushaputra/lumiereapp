<?php
    while($row = mysqli_fetch_assoc($query)){
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['user_id']}
                OR outgoing_msg_id = {$row['user_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No message available";
        (strlen($result) > 28) ? $msg =  substr($result, 0, 50) . '...' : $msg = $result;
        if(isset($row2['outgoing_msg_id'])){
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
        }else{
            $you = "";
        }
        ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
        ($outgoing_id == $row['user_id']) ? $hid_me = "hide" : $hid_me = "";

        
        $output .= ' <a href="../view/chat.php?user_id='. $row['user_id'] .'" class="text-decoration-none" style="color:black;">
        <div class="chat-item d-flex align-items-center p-2 border-bottom" style="border-radius: 50px;">
            <img src="../img/user.png" alt="User Avatar" class="rounded-circle me-2">
            <div>
                <h6 class="mb-0 fw-bold">'. $row['display_name']. '</h6>
                <span class="text-muted small" >'. $you . $msg .'</span>
            </div>
            <span class="online-status '. $offline .' ms-auto "><i class="fas fa-circle "></i></span>
        </div>
    </a>';



               
    }

    // while($row = mysqli_fetch_assoc($query)){
            
    
    //     $output .= ' <a href="chat.php?user_id='. $row['user_id'] .'" class="text-decoration-none" style="color:black;">
    //                 <div class="chat-item d-flex align-items-center p-2 border-bottom" style="border-radius: 50px;">
    //                     <img src="kecemasan.jpg" alt="User Avatar" class="rounded-circle me-2">
    //                     <div>
    //                         <h6 class="mb-0 fw-bold">'. $row['username']. '</h6>
    //                         <span class="text-muted small">'. $you . $msg .'</span>
    //                     </div>
    //                     <span class="online-status ms-auto '. $offline .'"><i class="fas fa-circle text-success"></i></span>
    //                 </div>
    //             </a>';


    // }
?>