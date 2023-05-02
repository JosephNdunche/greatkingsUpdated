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
    $lastname = $fetch_data['lastname'];
    $email = $fetch_data['email'];

}
?>

<?php

if(isset($_POST['approve-student'])){
    $student_id = $_POST['student_id'];
    $sql = "UPDATE users SET admin_verify='1', updated=NOW() WHERE student_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $student_id);
    if($stmt->execute()){
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
            <style>
            body{
                font-size: 20px;
            }
            </style>
        </head>
        <body>
            <h2>Hi, <span style="color: green;">'.$fetch_data['lastname'].'</span></h2>
            <p>if you are seeing this, then your account has been successfully verified by Great Kings Academy. you can Login now and access all the functionalities. for any enquiries contact Mr Odion.
            </p>
            <p style="color: green">Mr Odion<br />
            School Administrator
            </p>
        </body>
        </html>
        ';
        mail($email, $top, $body, $header);
        header("location: verified.php");

}
}
?>