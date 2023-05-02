<?php

$error = array();
$grade = "";

if(isset($_GET['unique_id']) ){
    $student_id = $_GET['unique_id'];
}
if(isset($_GET['student_course']) ){
    $student_course = $_GET['student_course'];
}
if(isset($_GET['student_session']) ){
    $student_session = $_GET['student_session'];
}
if(isset($_GET['student_term']) ){
    $student_term = $_GET['student_term'];
}
if(isset($_GET['student_first_term_score']) ){
    $student_first_term_score = $_GET['student_first_term_score'];
}
if(isset($_GET['student_second_term_score']) ){
    $student_second_term_score = $_GET['student_second_term_score'];
}

if(isset($_POST['result-btn2'])){
    
    $teacher_id = $_SESSION['admin'];

 
    $section = trim($_POST['section']);
    $section = stripslashes($section);
    $section = htmlspecialchars($section);

    $student_id = $_POST['student_id'];
    $student_course = $_POST['student_course'];
    $student_session = $_POST['student_session'];
    $student_term = $_POST['student_term'];
    $student_first_term_score = $_POST['student_first_term_score'];
    $student_second_term_score = $_POST['student_second_term_score'];

$term = trim($_POST['term']);
$term = stripslashes($term);
$term = htmlspecialchars($term);

$course = trim($_POST['course']);
$course = stripslashes($course);
$course = htmlspecialchars($course);

$first_term_score = trim($_POST['first_term_score']);
$first_term_score = stripslashes($first_term_score);
$first_term_score = htmlspecialchars($first_term_score);

$second_term_score = trim($_POST['second_term_score']);
$second_term_score = stripslashes($second_term_score);
$second_term_score = htmlspecialchars($second_term_score);

$test_score = trim($_POST['test_score']);
$test_score = stripslashes($test_score);
$test_score = htmlspecialchars($test_score);

$exam_score = trim($_POST['exam_score']);
$exam_score = stripslashes($exam_score);
$exam_score = htmlspecialchars($exam_score);

    if(empty($section)){
        $error['section'] = "This field cannot be empty";
    }
    if(empty($term)){
        $error['term'] = "This field cannot be empty";
    }
    if(empty($course)){
        $error['course'] = "This field cannot be empty";
    }
    if(empty($first_term_score)){
        $error['first_term_score'] = "This field cannot be empty";
    }
    if(empty($second_term_score)){
        $error['second_term_score'] = "This field cannot be empty";
    }
    if(empty($test_score)){
        $error['test_score'] = "This field cannot be empty";
    }
    if(empty($exam_score)){
        $error['exam_score'] = "This field cannot be empty";
    }
    

    if(count($error) === 0){
        $total_score = $test_score + $exam_score ;
        $approved = "0";
        $cummulative = $first_term_score + $second_term_score + $total_score;

        if($first_term_score == 0){
            $first_term_score = 0;
        }
        if($second_term_score == 0){
            $second_term_score = 0;
        }


        if($first_term_score == 0 && $second_term_score == 0){
            $amount = 1;
        } elseif ($first_term_score != 0 && $second_term_score == 0) {
            $amount = 2;
        } elseif ($second_term_score == 0 && $first_term_score != 0) {
            $amount = 2;
        } elseif ($second_term_score != 0 && $first_term_score != 0) {
            $amount = 3;
        }
        else{
            $amount = 3;
        }
        $percentage = ceil($cummulative / $amount);

if($percentage >= 75){
    $grade = "A1";
} elseif ($percentage >= 70 && $percentage < 75) {
    $grade = "B2";
} elseif ($percentage >= 65 && $percentage < 70) {
    $grade = "B3";
} elseif ($percentage >= 60 && $percentage < 65) {
    $grade = "C4";
} elseif ($percentage >= 55 && $percentage < 60) {
    $grade = "C5";
}  elseif ($percentage >= 50 && $percentage < 55) {
    $grade = "C6";
} elseif ($percentage >= 45 && $percentage < 50) {
    $grade = "D7";
}  elseif ($percentage >= 40 && $percentage < 45) {
    $grade = "E8";
}  elseif ($percentage < 40) {
    $grade = "F9";
}


$_SESSION['student_id'] = $student_id;
$_SESSION['student_course'] = $student_course;
$_SESSION['student_session'] = $student_session;
$_SESSION['student_term'] = $student_term;
$sql = "UPDATE result SET teacher_id=?, student_id=?, course=?, session=?, term=?, first_term_score=?, second_term_score=?, test_score=?, exam_score=?, total_score=?, cummulative=?, percentage=?, grade=?, date=NOW(), approved=? WHERE student_id=? AND course=? AND session=? AND term=? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt -> bind_param('ssssssssssssssssss', $teacher_id, $student_id, $course, $section, $term, $first_term_score, $second_term_score, $test_score, $exam_score, $total_score, $cummulative, $percentage, $grade, $approved, $student_id, $student_course, $student_session, $student_term);
        if($stmt->execute()){
            $_SESSION['student_id'] = $student_id;
            $_SESSION['course'] = $course;
            header("location: admin-result-success.php");
            exit();
        } else{
            "error";
        }
        }
    } 
