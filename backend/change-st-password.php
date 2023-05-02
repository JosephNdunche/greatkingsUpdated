<?php
require_once "database/connection.php";

$error = array();

if(isset($_POST['pass-btn'])){
    $code = $_SESSION['code'];

    $newpassword = trim($_POST['newpassword']);
    $newpassword = stripslashes($newpassword);
    $newpassword = htmlspecialchars($newpassword);

    $renewpassword = trim($_POST['renewpassword']);
    $renewpassword = stripslashes($renewpassword);
    $renewpassword = htmlspecialchars($renewpassword);

    $uppercase = preg_match("@[A-Z]@", $newpassword);
    $lowercase = preg_match("@[a-z]@", $newpassword);
    $number = preg_match("@[0-9]@", $newpassword);
    $specialchars = preg_match("@[^\w]@", $newpassword);

    
    if(empty($newpassword)){
        $error['newpassword'] = "This field cannot be empty";
    } elseif(!$uppercase || !$lowercase || !$number || !$specialchars || strlen($newpassword) < 8){
        $error['newpassword'] = "Password should be atleast 8 characters in length and should include at least one upper case letter, one number and one special character.";
    }

    if($newpassword !== $renewpassword){
        $error['renewpassword'] = "Password does not match";
    }

    if(count($error) === 0){
        $newpassword = password_hash($newpassword, PASSWORD_DEFAULT);
        $pwd_sql = "UPDATE staff SET password=? WHERE email_verify=?";
        $pwd_stmt = $conn->prepare($pwd_sql);
        $pwd_stmt->bind_param('ss', $newpassword, $code);
        if($pwd_stmt->execute()){

            echo "<script>location.href = 'staff-login.php';</script>";
            exit();
        } else{
            "error";
        }
    }
    
}