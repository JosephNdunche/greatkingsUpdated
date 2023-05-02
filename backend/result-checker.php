<?php

$error = [];
$student_fee = null;

if(isset($_POST['result-btn'])){
    
    $term = trim($_POST['term']);
    $term = stripslashes($term);
    $term = htmlspecialchars($term);

    $section = trim($_POST['session']);
    $section = stripslashes($section);
    $section = htmlspecialchars($section);

    $student_id = $_SESSION['student'];
    $sql = "SELECT * FROM result WHERE student_id=? AND term=? AND session=? AND approved='1'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $student_id, $term, $section);
    $stmt->execute();
    $result = $stmt->get_result();
    $num_of_rows = $result->num_rows;

    $sql = "SELECT * FROM scratch_card WHERE student_id=? AND term=? AND session=? AND verified='1'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $student_id, $term, $section);
    $stmt->execute();
    $get_result = $stmt->get_result();
    if($get_result->num_rows > 0){ 
        while($fetch_fees = $get_result -> fetch_assoc()){
            $student_fee += $fetch_fees['transfer_amount'];
        }
    }
    

    $sql = "SELECT * FROM scratch_card WHERE student_id=? AND term=? AND session=? AND verified='1'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $student_id, $term, $section);
    $stmt->execute();
    $get_result = $stmt->get_result();
    $fees_rows = $get_result->num_rows; 


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
        if(empty($term) || empty($section)){
            $error['result'] = "<div class='alert alert-danger'>No field should be empty</div>";
        }

     elseif($num_of_rows === 0){
        $error['result'] = "<div class='alert alert-danger'>No result yet, check later</div>";
    }    


    if(count($error) === 0){
        $_SESSION['term'] = $term;
        $_SESSION['session'] = $section;
        echo "<script>location.href = 'check-your-result.php';</script>";
    }

}