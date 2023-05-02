<?php

$error = [];

if(isset($_POST['manage-account'])){

    $account_name = trim($_POST['account_name']);
    $account_name = stripslashes($account_name);
    $account_name = htmlspecialchars($account_name);

    $account_number = trim($_POST['account_number']);
    $account_number = stripslashes($account_number);
    $account_number = htmlspecialchars($account_number);

    $account_bank = trim($_POST['account_bank']);
    $account_bank = stripslashes($account_bank);
    $account_bank = htmlspecialchars($account_bank);


    if(empty($account_name)){
        $error['account_name'] = "This field cannot be empty";
    } 

    if(empty($account_number)){
        $error['account_number'] = "This field cannot be empty";
    } 

    if(empty($account_bank)){
        $error['account_bank'] = "This field cannot be empty";
    } 

    if(count($error) === 0){
        $admin_id = $_SESSION['admin'];
        $sql = "UPDATE account SET admin_id=?, account_name=?, account_number=?, account_bank=?, updated=NOW()";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $admin_id, $account_name, $account_number, $account_bank);
        if($stmt->execute()){
            $id = "student";
            $message = $_SESSION['admin_lastname'] . ' ' . $_SESSION['admin_firstname'] . " has updated Great Kings Academy Bank Account Details";
            $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param('ss', $id, $message);
            if($notification_stmt->execute()){
                echo "<script>location.href = 'manage-account-success.php';</script>";
            exit();
        }} else{
            "error";
        }
    }
    
}