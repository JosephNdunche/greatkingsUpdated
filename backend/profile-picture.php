<?php

include "database/connection.php";

$error = array();

$student_id = $_SESSION['staff'];

if(isset($_POST['image-btn'])){
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
            $sql = "UPDATE staff SET image = '$fileNameNew' WHERE unique_id='$student_id'";
            $result = mysqli_query($conn, $sql);
            $_SESSION['staff_image'] = $fileNameNew;
            $admin_id = 'admin';
            $message = $_SESSION['staff_lastname'] . ' ' . $_SESSION['staff_firstname'] . " just updated his/her profile Picture in " . $_SESSION['staff_class'] . ' Class';
            $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param('ss', $admin_id, $message);
            if($notification_stmt->execute()){
            header("location: saved.php");
            }} else{
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
