<?php
require_once "database/connection.php";

$error = array();

if(isset($_POST['csp-btn'])){

    $uid = trim($_POST['uid']);
    $uid = stripslashes($uid);
    $uid = htmlspecialchars($uid);

    $newpassword = trim($_POST['newpassword']);
    $newpassword = stripslashes($newpassword);
    $newpassword = htmlspecialchars($newpassword);

    $renewpassword = trim($_POST['renewpassword']);
    $renewpassword = stripslashes($renewpassword);
    $renewpassword = htmlspecialchars($renewpassword);

    /*$uppercase = preg_match("@[A-Z]@", $newpassword);
    $lowercase = preg_match("@[a-z]@", $newpassword);
    $number = preg_match("@[0-9]@", $newpassword);
    $specialchars = preg_match("@[^\w]@", $newpassword);
    $student_id = $row['student_id'];*/

        $sql = "SELECT * FROM users WHERE email=? AND student_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $uid, $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows === 0){
            echo "<script>alert('Email does not exist on our Database');</script>";
            $error['uid'] = "Email does not exist on our Database";
        }

    
    elseif(empty($newpassword)){
        echo "<script>alert('No field should be empty');</script>";
        $error['newpassword'] = "No field should be empty";
    } /*elseif(!$uppercase || !$lowercase || !$number || !$specialchars || strlen($newpassword) < 8){
        $error['newpassword'] = "Password should be atleast 8 characters in length and should include at least one upper case letter, one number and one special character.";
    }*/

    elseif($newpassword !== $renewpassword){
        echo "<script>alert('Password does not match');</script>";
        $error['renewpassword'] = "Password does not match";
    }

    if(count($error) === 0){
        $newpassword = password_hash($newpassword, PASSWORD_DEFAULT);
        $pwd_sql = "UPDATE users SET password=? WHERE student_id=?";
        $pwd_stmt = $conn->prepare($pwd_sql);
        $pwd_stmt->bind_param('ss', $newpassword, $student_id);
        if($pwd_stmt->execute()){
            echo "<script>location.href = 'change-student-password-success.php';</script>";
            exit();
        } else{
            "error";
        }
    }
    
}