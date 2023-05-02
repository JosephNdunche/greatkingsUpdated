<?php
require "database/connection.php";

$error = array();

if(isset($_POST['password-btn'])){

    $password = trim($_POST['password']);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);

    $confirm_password = trim($_POST['confirm_password']);
    $confirm_password = stripslashes($confirm_password);
    $confirm_password = htmlspecialchars($confirm_password);

    /*$uppercase = preg_match("@[A-Z]@", $password);
    $lowercase = preg_match("@[a-z]@", $password);
    $number = preg_match("@[0-9]@", $password);
    $specialchars = preg_match("@[^\w]@", $password);*/
    
    if(empty($password)){
        $error['password'] = "This field cannot be empty";
    } /*elseif(!$uppercase || !$lowercase || !$number || !$specialchars || strlen($password) < 8){
        $error['password'] = "Password should be atleast 8 characters in length and should include at least one upper case letter, one number and one special character.";
    }*/
    if(empty($confirm_password)){
        $error['confirm_password'] = "This field cannot be empty";
    }

    if($password !== $confirm_password){
        $error['confirm_password'] = "Password does not match";
    }

    if(count($error) === 0){

        $password = password_hash($password, PASSWORD_DEFAULT);
        $unique_id = $_SESSION['staff'];
        $sql = "UPDATE staff SET password=? WHERE unique_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $password, $unique_id);
        
        if($stmt->execute()){
            $message = "You have successfully registered with Great Kings Academy.";
            $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param('ss', $unique_id, $message);
            if($notification_stmt->execute()){
                header("location: welcome.php");
            } 
        } else{
            $error['confirm_password'] = "An error occured, try again";
        }
}
    
}

