<?php

$error = [];

if(isset($_POST['class-timetable-btn'])){

    $timetable = trim($_POST['timetable']);
    $timetable = stripslashes($timetable);
    $timetable = htmlspecialchars($timetable);


    if(empty($timetable)){
        $error['timetable'] = "This field cannot be empty";
    }

    if(count($error) === 0){
        $staff_id = $_SESSION['staff'];
        $class = $_SESSION['staff_class'];
        $sql = "INSERT INTO class_timetable(staff_id, class, timetable, date) VALUES(?,?,?,NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $staff_id, $class, $timetable);
        if($stmt->execute()){
            $_SESSION['timetable-class'] = $class;
            header("location: class-timetable-success.php");
        }
    }
}


?>