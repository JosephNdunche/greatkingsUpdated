<?php

$error = [];

if(isset($_POST['manage-term'])){

    $term = trim($_POST['term']);
    $term = stripslashes($term);
    $term = htmlspecialchars($term);

    if(empty($term)){
        $error['term'] = "This field cannot be empty";
    } 

    if(count($error) === 0){
        $sql = "UPDATE set_term_tbl SET set_term=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $term);
        if($stmt->execute()){ 
            echo "<script>location.href = 'manage-term-success.php';</script>";
            exit();
        }} else{
            "error";
        }
    }
    
