<?php
if(isset($_GET['student_id'])){
    $student_id = $_GET['student_id'];
}
$sql = "SELECT * FROM users WHERE student_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $student_id);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0){
    $fetch_data = $result->fetch_assoc();
    $_SESSION['lastname'] = $fetch_data['lastname'];
    $_SESSION['firstname'] = $fetch_data['firstname'];
    $_SESSION['student_class'] = $fetch_data['class'];
}
?>

<?php

if(isset($_POST['admin-approve-student'])){
    $student_id = $_POST['student_id'];
    $sql = "UPDATE users SET admin_verify='1', updated=NOW() WHERE student_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $student_id);
    if($stmt->execute()){
        $email = $fetch_data['email'];;
        $from = "greatkings@greatkingsacademy.com.ng";
        $header = "Mime-Version: 1.0" . "\r\n";
        $header .= "Content-Type: text/html; charset=utf-8" . "\r\n";
        $header .= "From: " . $from;
        $top = "Account Approval";
        $body = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
            <h2>Hi, <span style="color: green;">'.$fetch_data['lastname'].'</span></h2>
            <p style="font-size: 22px;">if you are seeing this, then your account has been successfully verified by Great Kings Academy. you can Login now and access all the functionalities. for any enquiries contact Mr Odion. Your Student Id is '.$fetch_data['student_id'].' and you need it with your password to login to your account.
            </p>
            <p style="color: green">Mr Odion<br />
            School Administrator
            </p>
        </body>
        </html>
        ';
        mail($email, $top, $body, $header);
        $message = "Your account has been verified by " . $_SESSION['admin_lastname'] . ' ' . $_SESSION['admin_firstname'];
            $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param('ss', $student_id, $message);
            if($notification_stmt->execute()){
        header("location: admin-verified.php");
    }
}
}
?>

<?php

if(isset($_POST['admin-delete-student'])){
    $student_id = $_POST['student_id'];
    $sql = "DELETE FROM users WHERE student_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $student_id);
    if($stmt->execute()){
        header("location: admin-delete.php");
    }

}
?>