<?php
require_once "database/connection.php";

$error = array();

if(isset($_POST['cstaffp-btn'])){

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
    $student_id = $row['unique_id']; */

        $sql = "SELECT * FROM staff WHERE email=? AND unique_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss', $uid, $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows === 0){
            echo "<script>alert('Email does not exist on our Database');</script>";
            $error['staff'] = "<div class='alert alert-danger'>Email does not exist on our Database</div>";
        }

    
    elseif(empty($newpassword) || empty($renewpassword)){
        echo "<script>alert('No field should be empty');</script>";
        $error['staff'] = "<div class='alert alert-danger'>No field should be empty</div>";
    } /*elseif(!$uppercase || !$lowercase || !$number || !$specialchars || strlen($newpassword) < 8){
        $error['staff'] = "<div class='alert alert-danger'>Password should be atleast 8 characters in length and should include at least one upper case letter, one number and one special character.</div>";
    }*/

    elseif($newpassword !== $renewpassword){
        echo "<script>alert('Password does not match');</script>";
        $error['staff'] = "<div class='alert alert-danger'>Password does not match</div>";
    }

    if(count($error) === 0){
        $newpassword = password_hash($newpassword, PASSWORD_DEFAULT);
        $pwd_sql = "UPDATE staff SET password=? WHERE unique_id=?";
        $pwd_stmt = $conn->prepare($pwd_sql);
        $pwd_stmt->bind_param('ss', $newpassword, $student_id);
        if($pwd_stmt->execute()){
            echo "<script>location.href = 'change-staff-password-success.php';</script>";
            exit();
        } else{
            echo "<script>alert('error');</script>";
            $error['staff'] = "<div class='alert alert-danger'>error</div>";
        }
    }
    
}