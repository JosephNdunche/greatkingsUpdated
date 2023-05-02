<?php

$error = [];

if(isset($_POST['assignment-btn'])){

    $assignment = trim($_POST['assignment']);
    $assignment = stripslashes($assignment);
    $assignment = htmlspecialchars($assignment);

    $subject = trim($_POST['subject']);
    $subject = stripslashes($subject);
    $subject = htmlspecialchars($subject);

    $class = trim($_POST['class']);
    $class = stripslashes($class);
    $class = htmlspecialchars($class);

    $deadline = trim($_POST['deadline']);
    $deadline = stripslashes($deadline);
    $deadline = htmlspecialchars($deadline);

    if(empty($class)){
        $error['class'] = "This field cannot be empty";
    }
    if(empty($subject)){
        $error['subject'] = "This field cannot be empty";
    }

    if(count($error) === 0){
        
         $staff_id = $_SESSION['staff'];
        $sql = "INSERT INTO assignment(staff_id, class, subject, assignment, deadline, date) VALUES(?,?,?,?,?,NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssss', $staff_id, $class, $subject, $assignment, $deadline);
        if($stmt->execute()){
            $email_sql = "SELECT * FROM users WHERE class='$class'";
                $email_stmt = $conn->prepare($email_sql);
                $email_stmt->execute();
                $email_result = $email_stmt->get_result();
                if($email_result->num_rows > 0){
                    while($email_row = $email_result->fetch_assoc()){
                        $from = "email@greatkingsacademy.com.ng";
                        $header = "Mime-Version: 1.0" . "\r\n";
                        $header .= "Content-Type: text/html; charset=utf-8" . "\r\n";
                        $header .= "From: " . $from;
                        $top = $subject . " Assignment";
                        $body = '
                        <!DOCTYPE html>
                        <html lang="en">
                        <head>
                            <meta charset="UTF-8">
                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <!-- Favicons -->
                            <link href="https://www.florierenparklaneis.com.ng/index/assets/img/favicon.png" rel="icon">
                            <link href="https://www.florierenparklaneis.com.ng/index/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
                            <!-- Google Fonts -->
                            <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
                            <link href="https://www.florierenparklaneis.com.ng/index/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
                            <title>Verify Email Account</title>
                
                        </head>
                        <body style="font-size: 22px;">
                            <div class="container">
                                <div class="text-center my-3">
                                <img src="https://www.florierenparklaneis.com.ng/index/assets/img/florieren/logo.png" class="img-fluid" alt="">
                                </div>
                                <p>You have been given '.$subject.' Assignment and the deadline is on '.$deadline.'.</p>
                
                                <p>Thank you for your time with us <br /><br /><br />
                                GreatKings Academy 
                            </p>
                
                            </div>
                            <script src="https://www.florierenparklaneis.com.ng/index/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                        </body>
                        </html>
                        ';
                        mail($email, $top, $body, $header); 
                    }
                }

            $_SESSION['assignment-class'] = $class;
            $_SESSION['assignment-subject'] = $subject;
            $admin_id = 'admin';
            $message = $_SESSION['staff_lastname'] . ' ' . $_SESSION['staff_firstname'] . " just uploaded an assignment to " . $_SESSION['staff_class'] . ' Class';
            $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param('ss', $admin_id, $message);
            if($notification_stmt->execute()){
                
            echo "<script>location.href = 'assignment-success.php';</script>";
        }
                 
    
        }   
        
    }

}

    

?>


