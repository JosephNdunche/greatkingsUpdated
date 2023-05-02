<?php
    if(isset($_POST['payment'])){
      $student_id = $_POST['student_id'];
        $sql = "UPDATE scratch_card SET verified='1', admin_date=NOW() WHERE student_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $student_id);
        if($stmt->execute()){
          $message = "Your payment has been verified by the admin, you can print your receipt.";
          $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
          $notification_stmt = $conn->prepare($notification_sql);
          $notification_stmt->bind_param('ss', $student_id, $message);
          if($notification_stmt->execute()){
            header("location: successful-payment.php");
        }

        }
      }
?>
