<?php

$error = [];

$student_id = $_SESSION['student'];

if(isset($_POST['payment-btn'])){

    $amount = trim($_POST['amount']);
    $amount = stripslashes($amount);
    $amount = htmlspecialchars($amount);

    $date = trim($_POST['date']);
    $date = stripslashes($date);
    $date = htmlspecialchars($date);

    if(empty($amount)){
        $error['amount'] = "This field cannot be empty";       
    }
    elseif($amount !== '700'){
        $error['amount'] = "The amount to pay is 700 Naira";
    }
    if(empty($date)){
        $error['date'] = "This field cannot be empty";       
    }

    if(count($error) === 0){
    if(isset($_FILES['file'])){
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name']; 
    $fileTmp = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $_FILES['file']['name']);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png');
    if(in_array($fileActualExt, $allowed)){
        if($_FILES['file']['error'] === 0){
        if($_FILES['file']['size'] < 1000000){
            $fileNameNew = time() . '.' . $fileActualExt;
            $fileDestination = 'uploads/'. $fileNameNew;
            if(move_uploaded_file($_FILES['file']['tmp_name'], $fileDestination)){
                $verified = "0";
                $sql = "INSERT INTO scratch_card(student_id, transfer_amount, upload, transfer_date, verified, date) VALUES(?,?,?,?,?, NOW())";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('sssss', $student_id, $amount, $fileNameNew, $date, $verified);
                if($stmt->execute()){  
                    $admin_id = 'admin';
            $message = $_SESSION['lastname'] . ' ' . $_SESSION['firstname'] . " just uploaded his scratch card payment receipt in " . $_SESSION['class'] . " class";
            $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param('ss', $admin_id, $message);
            if($notification_stmt->execute()){
            header("location: check-result.php");
                }}else{
                    $error['file'] = "An error occurred, try again";
                }
            } else{
                $error['file'] = "Not moved";
            }
        } else{
            $error['file'] = "Your file is too long";
        }}
        else{
            $error['file'] = "An error occured";
        }  }
        else{
            $error['file'] = "you cannot upload files of this file";
        }
    

    }    
    }
}