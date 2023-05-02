<?php
if(isset($_GET['staff_id'])){
    $staff_id = $_GET['staff_id'];
}
$sql = "SELECT * FROM staff WHERE unique_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $staff_id);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0){
    $fetch_data = $result->fetch_assoc();
    $_SESSION['staff_lastname'] = $fetch_data['lastname'];
    $email = $fetch_data['email'];
}
?>

<?php

if(isset($_POST['approve-staff'])){
    $staff_id = $_POST['staff_id'];
    $sql = "UPDATE staff SET admin_verify='1', updated=NOW() WHERE unique_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $staff_id);
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
            <p>if you are seeing this, then your account has been successfully verified by Great Kings Academy. you can Login now and access all the functionalities. for any enquiries contact Mr Odion.<br />
            Your Staff Id is '.$fetch_data['student_id'].' and you need it with your password to login to your account.
            </p>
            <p style="color: green">Mr Odion<br />
            School Administrator
            </p>
        </body>
        </html>
        ';
        mail($email, $top, $body, $header);
        $message = "Dear " . $_SESSION['staff_lastname'] . ", Your account has been verified by " . $_SESSION['admin_lastname'] . ' ' . $_SESSION['admin_firstname'];
            $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param('ss', $staff_id, $message);
            if($notification_stmt->execute()){
              header("location: verify-staff.php");
    }
}
}
?>

<?php

if(isset($_POST['delete-staff'])){
    $staff_id = $_POST['staff_id'];
    $sql = "DELETE FROM staff WHERE unique_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $staff_id);
    if($stmt->execute()){      
        header("location: delete-staff.php");
    }
}

?>