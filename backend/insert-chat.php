<?php

if(isset($_POST['chat_btn'])){

    $outgoing_id = $_POST['outgoing_id'];
    $incoming_id = $_POST['incoming_id'];
    $message = $_POST['message'];
    $error = "";

    if(!empty($message)){
        $data = array(
            'outgoing_id' => $outgoing_id,
            'incoming_id' => $incoming_id,
            'message' => $message,
        );
        $sql = "INSERT INTO messages(incoming_msg_id, outgoing_msg_id, message) VALUES('$incoming_id','$outgoing_id', '$message')";
        $stmt = $conn->prepare($sql);
        $stmt->execute($data);
            
    } else{
        $error = "an error occured";
    }
    $output = array(
        'error' => $error
    );
    echo json_encode($output);

}