<?php

$error = [];

if(isset($_POST['exam-timetable-btn'])){

    $timetable = trim($_POST['timetable']);
    $timetable = stripslashes($timetable);
    $timetable = htmlspecialchars($timetable);

    $user = trim($_POST['user']);
    $user = stripslashes($user);
    $user = htmlspecialchars($user);


    if(empty($timetable)){
        $error['timetable'] = "This field cannot be empty";
    }

    if(count($error) === 0){
        $staff_id = $_SESSION['admin'];
        $sql = "INSERT INTO exam_timetable(staff_id, user, timetable, date) VALUES(?,?,?,NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $staff_id, $user, $timetable);
        if($stmt->execute()){
            $not_id = 'student';
            $_SESSION['timetable-user'] = $user;
            $message = $user . " exam timetable is ready, for more updates, call the admin.";
            $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param('ss', $not_id, $message);
            if($notification_stmt->execute()){
            header("location: exam-timetable-success.php");
        }}
    }
}


?>