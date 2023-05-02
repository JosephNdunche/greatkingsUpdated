<?php

$error = [];

$staff_id = $_SESSION['staff'];

if(isset($_POST['library-btn'])){

    $course = trim($_POST['course']);
    $course = stripslashes($course);
    $course = htmlspecialchars($course);

    $class = trim($_POST['class']);
    $class = stripslashes($class);
    $class = htmlspecialchars($class);

    $assignment = trim($_POST['assignment']);
    $assignment = stripslashes($assignment);
    $assignment = htmlspecialchars($assignment);

    if(empty($course)){
        $error['course'] = "This field cannot be empty";
    }   

    if(empty($class)){
        $error['class'] = "This field cannot be empty";
    } 


    if(empty($assignment)){
        $error['assignment'] = "This field cannot be empty";
    } 
    if(isset($_FILES['file'])){
        $file = $_FILES['file'];
        $fileName = $_FILES['file']['name']; 
        $fileTmp = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];
    
        $fileExt = explode('.', $_FILES['file']['name']);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'png','pdf');
        if(in_array($fileActualExt, $allowed)){
            if($_FILES['file']['error'] === 0){
            if($_FILES['file']['size'] < 2000000){
                $fileNameNew = time() . '.' . $fileActualExt;
                $fileDestination = 'uploads/'. $fileNameNew;
                if(move_uploaded_file($_FILES['file']['tmp_name'], $fileDestination)){
                $_SESSION['file'] = $fileNameNew;
                } else{
                    $error['file'] = "Not moved";
                }
            } else{
                $error['file'] = "Your file is too long";
            }}
            else{
                $error['file'] = "An error occured";
            }  }
            else{
                $error['file'] = "you cannot upload files of this file";
            }
        
    
        }    

   
    if(count($error) === 0){
        $sql = "INSERT INTO library (staff_id, course, class, pdf, about, verify, date) VALUES(?,?,?,?,?, '0', NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssss', $staff_id, $course, $class, $fileNameNew, $assignment);
        if($stmt->execute()){
            $_SESSION['library_course'] = $course;
            $_SESSION['library_class'] = $class;
            $admin_id = "admin";
            $message = $_SESSION['staff_lastname'] . ' ' . $_SESSION['staff_firstname'] . " just uploaded " . $course . " course to " . $class . " class. approve the book for it to be visible to the students.";
            $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param('ss', $admin_id, $message);
            if($notification_stmt->execute()){
              echo '<script>location.href = "library-success.php";</script>';
            exit();
            }
        } else{
            echo "error";
        }
    }
    
}