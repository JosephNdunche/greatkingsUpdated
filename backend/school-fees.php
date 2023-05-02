<?php

$error = [];

$student_id = $_SESSION['student'];

$term_sql = "SELECT * FROM set_term_tbl";
$term_stmt = $conn->prepare($term_sql); 
$term_stmt->execute();
$term_result = $term_stmt->get_result();
if($term_result->num_rows > 0){
    $get_term_result = $term_result->fetch_assoc();
}
$term = $get_term_result['set_term'];

$session_sql = "SELECT * FROM set_session_tbl";
$session_stmt = $conn->prepare($session_sql); 
$session_stmt->execute();
$session_result = $session_stmt->get_result();
if($session_result->num_rows > 0){
    $get_session_result = $session_result->fetch_assoc();
}
$session = $get_session_result['set_session'];

$fees_sql = "SELECT * FROM manage_fees_tbl";
$fees_stmt = $conn->prepare($fees_sql); 
$fees_stmt->execute();
$fees_result = $fees_stmt->get_result();
if($fees_result->num_rows > 0){
    $get_fees_result = $fees_result->fetch_assoc();
}
if($row['class'] === 'Jss-1' || $row['class'] === 'Jss-2' || $row['class'] === 'Jss-3'){
    $fees = $get_fees_result['manage_junior_fees'];
    } else{
      $fees = $get_fees_result['manage_senior_fees'];
    }
    if($fees === ''){
      $fees = 0;
    }
$ratio = $fees * 0.4;;

if(isset($_POST['school-fees-btn'])){

    $amount = trim($_POST['amount']);
    $amount = stripslashes($amount);
    $amount = htmlspecialchars($amount);

    $date = trim($_POST['date']);
    $date = stripslashes($date);
    $date = htmlspecialchars($date);

    if(empty($amount) || empty($date)){
        $error['file'] = "<div class='alert alert-danger'>No field should be empty</div>";       
    }
    elseif($amount < $ratio){
        $error['file'] = "<div class='alert alert-danger'>The amount to pay must be greater than " . $ratio ." Naira (40%)</div>";
    }

    if(count($error) === 0){
    if(isset($_FILES['file'])){
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name']; 
    $fileTmp = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $_FILES['file']['name']);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png');
    if(in_array($fileActualExt, $allowed)){
        if($_FILES['file']['error'] === 0){
        if($_FILES['file']['size'] < 1000000000){
            $fileNameNew = time() . '.' . $fileActualExt;
            $fileDestination = 'uploads/'. $fileNameNew;
            if(move_uploaded_file($_FILES['file']['tmp_name'], $fileDestination)){
                $verified = "0";
                $sql = "INSERT INTO scratch_card(student_id, transfer_amount, upload, term, session,transfer_date, verified, date) VALUES(?,?,?,?,?,?,?, NOW())";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('sssssss', $student_id, $amount, $fileNameNew, $term, $session, $date, $verified);
                if($stmt->execute()){  
                    $admin_id = 'admin';
            $message = $_SESSION['lastname'] . ' ' . $_SESSION['firstname'] . " just uploaded his School Fees payment receipt in " . $_SESSION['class'] . " class";
            $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param('ss', $admin_id, $message);
            if($notification_stmt->execute()){
            echo "<script>location.href = 'check-result.php'</script>";
                }}else{
                    $error['file'] = "<div class='alert alert-danger'>An error occurred, try again</div>";
                }
            } else{
                $error['file'] = "<div class='alert alert-danger'>Not moved</div>";
            }
        } else{
            $error['file'] = "<div class='alert alert-danger'>Your file is too long</div>";
        }}
        else{
            $error['file'] = "<div class='alert alert-danger'>An error occured</div>";
        }  }
        else{
            $error['file'] = "<div class='alert alert-danger'>you cannot upload files of this type</div>";
        }
    

    }    
    }
}