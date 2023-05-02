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

    if(empty($firstname) || empty($lastname) || empty($email) || empty($telephone) || empty($class) || empty($password) || empty($confirm_password)){
        $error['register_student'] = "<div class='alert alert-danger'>Fill in all the fields</div>";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error['register_student'] = "<div class='alert alert-danger'>Invalid email format</div>";
    }

    elseif(!preg_match("@[0-9]@", $telephone)){
        $error['register_student'] = "<div class='alert alert-danger'>Invalid Telephone format</div>";
    }
    
    /*elseif(!$uppercase || !$lowercase || !$number || !$specialchars || strlen($password) < 8){
        $error['register_student'] = "<div class='alert alert-danger'>Password should be atleast 8 characters in length and should include at least one upper case letter, one number and one special character.</div>";
    }*/

    elseif($password !== $confirm_password){
        $error['register_student'] = "<div class='alert alert-danger'>Password does not match</div>";
    }

    if(count($error) === 0){
        $password = password_hash($password, PASSWORD_DEFAULT);
        $unique_id = 'greatkings/'. date('Y'). '/' . bin2hex(random_bytes(2));
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
        $sql = "INSERT INTO users (student_id, firstname, lastname, email, telephone, class, image, parent_image, password, admin_verify, email_verify, v_email, date) VALUES(?,?,?,?,?,?,?,?,?,?,?,?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssssssssss', $unique_id, $firstname, $lastname, $email, $telephone, $class, $image, $image, $password, $verified, $verify_email, $verified);
        if($stmt->execute()){
           
            $_SESSION['student'] = $unique_id;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['email'] = $email;
            $_SESSION['telephone'] = $telephone;
            $_SESSION['class'] = $class;
            $message = $_SESSION['lastname'] . ' ' . $_SESSION['firstname'] . " just Registered with Great Kings Academy in " . $_SESSION['class'] . " Class";
            $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES('admin',?,NOW())";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param('s', $message);
            if($notification_stmt->execute()){
                echo "<script>location.href = 'welcome-student.php';</script>";
            } 
        } else{
            $error['register_student'] = "<div class='alert alert-danger'>An error occured, try again</div>";
        }
}
    
}

