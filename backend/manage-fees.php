<?php

$error = [];

if(isset($_POST['manage-fees'])){

    $senior = trim($_POST['senior']);
    $senior = stripslashes($senior);
    $senior = htmlspecialchars($senior);

    $junior = trim($_POST['junior']);
    $junior = stripslashes($junior);
    $junior = htmlspecialchars($junior);

    if(empty($senior) || empty($junior)){
        $error['fees'] = "No field should be empty";
    } 

    if(count($error) === 0){
        $sql = "UPDATE manage_fees_tbl SET manage_senior_fees=?, manage_junior_fees=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $senior, $junior);
        if($stmt->execute()){ 
            echo "<script>location.href = 'manage-fees-success.php';</script>";
            exit();
        }} else{
            "error";
        }
    }
    
