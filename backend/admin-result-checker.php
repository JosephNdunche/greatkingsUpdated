<?php


if(isset($_GET['student_id'])){
    $student_id = $_GET['student_id'];
} 

$error = array();

if(isset($_POST['result-btn'])){
    
    $term = trim($_POST['term']);
    $term = stripslashes($term);
    $term = htmlspecialchars($term);

    $section = trim($_POST['session']);
    $section = stripslashes($section);
    $section = htmlspecialchars($section);

    $student_id = $_POST['student_id'];

    if(empty($term)){
        $error['term'] = "This field cannot be empty";
    }


    $sql = "SELECT * FROM result WHERE student_id=? AND term=? AND session=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $student_id, $term, $section);
    $stmt->execute();
    $result = $stmt->get_result();
    $num_of_rows = $result->num_rows;

    if(empty($section)){
        $error['section'] = "this field cannot be empty";
    }
    elseif($num_of_rows === 0){
        $error['result'] = "No result yet, check later";
    }

    if(count($error) === 0){
        $_SESSION['term'] = $term;
        $_SESSION['session'] = $section;
        $_SESSION['student_id'] = $student_id;
        header("location: admin-checking-result.php");
    }

}