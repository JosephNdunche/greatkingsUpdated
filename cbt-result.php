<?php require "student-header.php"; ?>


<?php 
$answer = 0;

  $student_course = $_SESSION['student_course'];
  $student_class = $row['class']; 
  $student_id = $row['student_id'];

  $sql = "SELECT * FROM cbt WHERE class='$student_class' AND course='$student_course'";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  if($result->num_rows > 0){
    $num = $result->num_rows;
    while($rows = $result->fetch_assoc()){
        $a = $rows['answer'];
        $cbt_id = $rows['cbt_id'];

        $a_sql = "SELECT * FROM student_answer WHERE cbt_id='$cbt_id' AND student_pick='$a' AND student_id='$student_id'";
        $a_stmt = $conn->prepare($a_sql);
        $a_stmt->execute();
        $a_result = $a_stmt->get_result();
        $answer += $a_result->num_rows;
    
  }
  $i_sql = "INSERT INTO cbt_result (student_id, student_score) VALUES('$student_id', '$answer')";
  $i_stmt = $conn->prepare($i_sql);
  $i_stmt->execute();


}

?>


<section class="signup py-5 mt-5">
<div class="container">
<div class="text-center">
    <i class="bi bi-check-circle-fill text-success" style="font-size: 3.5rem;"></i>
    </div>
    <p class="text-center">You have successfully finished your test and you got  <span class="text-success"><?= $answer; ?> / <?= $num; ?></span> </p>
    <a href="student-dashboard.php" class="bg-success text-white form-control text-center py-2" style="border-radius: 15px;">Continue</a>
</div>
</section>   


<?php require "main-footer.php"; ?>