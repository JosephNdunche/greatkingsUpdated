<?php

$error = array();

if(isset($_POST['post-btn'])){

    $user = trim($_POST['user']);
    $user = stripslashes($user);
    $user = htmlspecialchars($user);

    $message = trim($_POST['message']);
    $message = stripslashes($message);
    $message = htmlspecialchars($message);


    if(empty($user)){
        $error['user'] = "This field cannot be empty";
    }

    if(empty($message)){
        $error['message'] = "This field cannot be empty";
    } 

    

    if(count($error) === 0){
        $admin_id = $_SESSION['admin'];

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
        if($_FILES['file']['size'] < 1000000000){
            $fileNameNew = time() . '.' . $fileActualExt;
            $fileDestination = 'uploads/'. $fileNameNew;
            if(move_uploaded_file($_FILES['file']['tmp_name'], $fileDestination)){
            $sql = "INSERT INTO post (admin_id, image, text, user, time) VALUES('$admin_id', '$fileNameNew', '$message', '$user', NOW())";
            $stmt = $conn->prepare($sql);
            if($stmt->execute()){
            $_SESSION['user'] = $user;
            $message = $_SESSION['admin_lastname'] . ' ' . $_SESSION['admin_firstname']." just posted on the school feed";
            $student_id = "student";
            $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param('ss', $student_id, $message);
            if($notification_stmt->execute()){
            echo "<script>location.href = 'post-success.php';</script>";
            } }}else{
                $error['file'] = "Not moved";
            }
        } else{
            $error['file'] = "The file is too long";
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


