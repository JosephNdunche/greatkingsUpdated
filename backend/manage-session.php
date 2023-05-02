<?php

$error = [];

if(isset($_POST['manage-session'])){

    $session = trim($_POST['session']);
    $session = stripslashes($session);
    $session = htmlspecialchars($session);

    if(empty($session)){
        $error['session'] = "This field cannot be empty";
    } 

    if(count($error) === 0){
        $sql = "UPDATE set_session_tbl SET set_session=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $session);
        if($stmt->execute()){ 
            echo "<script>location.href = 'manage-session-success.php';</script>";
            exit();
        }} else{
            "error";
        }
    }
    
