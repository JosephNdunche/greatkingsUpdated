<?php

if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
}

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

if(isset($_POST['teacher-comment-btn'])){

    $present = trim($_POST['present']);
    $present = stripslashes($present);
    $present = htmlspecialchars($present);

    $student_id = $_POST['student_id'];

    $present_sql = "UPDATE attendance SET principal_comment=? WHERE student_id=? AND term=? AND session=?";
    $present_stmt = $conn->prepare($present_sql);
    $present_stmt->bind_param('ssss', $present, $student_id, $term, $session);
    if($present_stmt->execute()){
        echo "<script>location.href = 'admin-checking-result.php';</script>";
    }


}