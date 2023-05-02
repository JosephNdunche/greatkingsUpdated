<?php

if(isset($_POST['chat-btn'])){

    $outgoing_id = $_POST['outgoing_id'];
    $incoming_id = $_POST['incoming_id'];


        $sql = "SELECT * FROM messages WHERE (ongoing_msg_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $incoming_id, $outgoing_id, $message);
        if($stmt->execute()){
            header("location: djjjdjdj.php");
        } 
    

}