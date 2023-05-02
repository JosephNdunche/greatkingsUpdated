<?php
require "database/connection.php";

$error = array();

if(isset($_POST['sfp-btn'])){

    $email = trim($_POST['email']);
    $email = stripslashes($email);
    $email = htmlspecialchars($email);


    if(empty($email)){
        $error['email'] = "This field cannot be empty";
    } 


    if(count($error) === 0){

        $sql = "SELECT * FROM staff WHERE unique_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $fetch = $result->fetch_assoc();
            $code = $fetch['verify_email'];
            $user_email = $fetch['email'];
            $from = "greatkings@greatkingsacademy.com.ng";
        $header = "Mime-Version: 1.0" . "\r\n";
        $header .= "Content-Type: text/html; charset=utf-8" . "\r\n";
        $header .= "From: " . $from;
        $top = "Change Password";
        $body = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body style="color: #444;">
            <h2>Hi, <span style="color: green;">'.$fetch['lastname'].'</span></h2>
            <p>We Great Kings Academy make sure your password is well secured and we assure you that your account details is well protected.</p>
            <p>Your 8 verification code is <span style="color: green;">'. $fetch['email_verify  '] .'</span></p>
        </body>
        </html>
        ';
        mail($user_email, $top, $body, $header);
            $_SESSION['csp'] = bin2hex(random_bytes(4));;
            $_SESSION['email'] = $fetch['email'];
            $_SESSION['code'] = $code;


            echo '<script>location.href = "sfp.php";</script>';
           
            } else {
                $error['email'] = "Unique Id does not exist";
            }
        }
       
        
    }



