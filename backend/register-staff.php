<?php
require "database/connection.php";

$error = array();

if(isset($_POST['submit-btn'])){

    $firstname = trim($_POST['firstname']);
    $firstname = stripslashes($firstname);
    $firstname = htmlspecialchars($firstname);

    $lastname = trim($_POST['lastname']);
    $lastname = stripslashes($lastname);
    $lastname = htmlspecialchars($lastname);

    $email = trim($_POST['email']);
    $email = stripslashes($email);
    $email = htmlspecialchars($email);

    $telephone = trim($_POST['telephone']);
    $telephone = stripslashes($telephone);
    $telephone = htmlspecialchars($telephone);

    $class = $_POST['class'];

    if(empty($firstname) || empty($lastname) || empty($email) || empty($telephone) || empty($class)){
        $error['staff'] = "<div class='alert alert-danger'>This field cannot be empty</div>";
    }

    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error['staff'] = "<div class='alert alert-danger'>Invalid email format</div>";
    }

    elseif(!preg_match("@[0-9]@", $telephone)){
        $error['staff'] = "<div class='alert alert-danger'>Invalid Telephone format</div>";
    }

    if(count($error) === 0){
        $unique_id = 'staff/'. date('Y'). '/' . bin2hex(random_bytes(2));
        $verify_email = bin2hex(random_bytes(4));
        $verified = '0';
        
        $from = "greatkings@greatkingsacademy.com.ng";
        $header = "Mime-Version: 1.0" . "\r\n";
        $header .= "Content-Type: text/html; charset=utf-8" . "\r\n";
        $header .= "From: " . $from;
        $top = "Verify Email Account";
        $body = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <!-- Favicons -->
            <link href="https://www.greatkingsacademy.com.ng/assets/img/favicon.png" rel="icon">
            <link href="https://www.greatkingsacademy.com.ng/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
            <title>Verify Email Account</title>

        </head>
        <body style="font-size: 25px;">
            <div class="container">
                <div style="text-align: center;" class="text-center my-3">
                <img src="https://www.greatkingsacademy.com.ng/assets/img/florieren/logo.png" style="width: 60px;" alt="">
                </div>
                <h2>Hi, <span style="color: green;">'.$lastname.'</span></h2>
                <p>You are welcome to Great Kings Academy, A school where we provide a conducive learning environment and qualified team of experienced and eloquent seasoned staff for our students.</p>
                <p>Your 8 verification code is <span style="color: green;">'. $verify_email .'</span></p>

            </div>
        </body>
        </html>
        ';
        mail($email, $top, $body, $header);
        $image = "image.png";
        $sql = "INSERT INTO staff (unique_id, firstname, lastname, email, telephone, class, image, admin_verify, email_verify, v_email, date) VALUES(?,?,?,?,?,?,?,?,?,?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssssssss', $unique_id, $firstname, $lastname, $email, $telephone, $class, $image, $verified, $verify_email, $verified);
        if($stmt->execute()){
            $_SESSION['staff'] = $unique_id;
            $_SESSION['staff_firstname'] = $firstname;
            $_SESSION['staff_lastname'] = $lastname;
            $_SESSION['staff_email'] = $email;
            $_SESSION['staff_telephone'] = $telephone;
            $_SESSION['staff_class'] = $class;
            $_SESSION['staff_verify_email'] = $verify_email;
            $_SESSION['staff_verify_staff'] = $verified;

            $admin_id = 'admin';
            $message = $_SESSION['staff_lastname'] . ' ' . $_SESSION['staff_firstname'] . " just registered with Great Kings Academy in " . $_SESSION['staff_class'] . ' Class';
            $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param('ss', $admin_id, $message);
            if($notification_stmt->execute()){
            
            header("location: staff-password.php");
        }} else{
            $error['staff'] = "<div class='alert alert-danger'>An error occured, try again</div>";
        }
}
    
}

