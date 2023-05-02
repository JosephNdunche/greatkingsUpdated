<?php
require "database/connection.php";
$error = [];

if(isset($_POST['check-scratchcard'])){
  $verify_email = $_POST['code'];

  if(empty($verify_email)){
    $error['error'] = "This field cannot be empty";
  }

  if(count($error) == 0){
    $staff = $_SESSION['student'];
    
    $sql = "SELECT * FROM scratch_card WHERE student_id=? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $staff);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
      $fetch = $result->fetch_assoc();
  
      if($fetch['scratch_card'] === $verify_email){
        echo "<script>location.href = 'student-checking-result.php';</script>";
      } else{
        $error['error'] = "The code does not match";
      }
    } else{
      $error['error'] = "No user like that";
    }
  }
}

?>