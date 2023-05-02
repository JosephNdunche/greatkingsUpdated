<?php

include "database/connection.php";

$error = array();

$student_id = $_SESSION['student'];

if(isset($_POST['parent-btn'])){
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
            $sql = "UPDATE users SET parent_image = '$fileNameNew' WHERE student_id='$student_id'";
            $result = mysqli_query($conn, $sql);
            $_SESSION['image'] = $fileNameNew;
            $message = $_SESSION['lastname'] . ' ' . $_SESSION['firstname'] . " has just updated his/her profile picture.";
            $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES('admin',?,NOW())";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param('s', $message);
            if($notification_stmt->execute()){
            header("location: student-saved.php");
            } }else{
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
