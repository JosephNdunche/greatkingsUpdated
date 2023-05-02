<?php
             
             $error = [];
             if(isset($_POST['admin-view-library'])){
                if(isset($_GET['library_id'])){
                    $library_id = $_GET['library_id'];
                   } 
                $library_id = $_POST['library_id'];
                $sql = "SELECT * FROM  library WHERE library_id='$library_id'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                if($result->num_rows > 0){
               $get_data = $result->fetch_assoc();
               $staff_id = $get_data['staff_id'];
               $_SESSION['library_course'] = $get_data['course'];
               $sql1 = "UPDATE library SET verify='1' WHERE library_id='$library_id'";
               $stmt1 = $conn->prepare($sql1);
               if($stmt1->execute()){$message = "Your book has been approved by " . $_SESSION['admin_lastname'] . ' ' . $_SESSION['admin_firstname'];
                $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
                $notification_stmt = $conn->prepare($notification_sql);
                $notification_stmt->bind_param('ss', $staff_id, $message);
                if($notification_stmt->execute()){
                echo "<script>location.href = 'verify-library.php';</script>";
               }
             }
            }
          }
?>