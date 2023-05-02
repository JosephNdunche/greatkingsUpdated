<?php

$error = [];

if(isset($_POST['update-profile'])){
    
    $firstname = trim($_POST['firstname']);
    $firstname = stripslashes($firstname);
    $firstname = htmlspecialchars($firstname);

    $lastname = trim($_POST['lastname']);
    $lastname = stripslashes($lastname);
    $lastname = htmlspecialchars($lastname);

    $email = trim($_POST['email']);
    $email = stripslashes($email);
    $email = htmlspecialchars($email);

    $telephone = trim($_POST['telephone']);
    $telephone = stripslashes($telephone);
    $telephone = htmlspecialchars($telephone);

    $class = trim($_POST['class']);
    $class = stripslashes($class);
    $class = htmlspecialchars($class);

    $state_of_origin = trim($_POST['state_of_origin']);
    $state_of_origin = stripslashes($state_of_origin);
    $state_of_origin = htmlspecialchars($state_of_origin);

    $date_of_birth = trim($_POST['date_of_birth']);
    $date_of_birth = stripslashes($date_of_birth);
    $date_of_birth = htmlspecialchars($date_of_birth);

    $address = trim($_POST['address']);
    $address = stripslashes($address);
    $address = htmlspecialchars($address);

    $about = trim($_POST['about']);
    $about = stripslashes($about);
    $about = htmlspecialchars($about);

    $father_name = trim($_POST['father_name']);
    $father_name = stripslashes($father_name);
    $father_name = htmlspecialchars($father_name);

    $mother_name = trim($_POST['mother_name']);
    $mother_name = stripslashes($mother_name);
    $mother_name = htmlspecialchars($mother_name);

    $year_of_admission = trim($_POST['year_of_admission']);
    $year_of_admission = stripslashes($year_of_admission);
    $year_of_admission = htmlspecialchars($year_of_admission);

    $staff_id = $_SESSION['student'];

    if(empty($firstname) || empty($lastname) || empty($email) || empty($telephone) || empty($class) || empty($state_of_origin) || empty($date_of_birth) || empty($address) || empty($about) || empty($father_name) || empty($mother_name) || empty($year_of_admission)){
        echo "<script>alert('No field should be empty');</script>";
        $error['student'] = "<div class='alert alert-danger'>No field should be empty</div>";
    } 

    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<script>alert('Invalid email format');</script>";
        $error['student'] = "<div class='alert alert-danger'>Invalid email format</div>";
    }

    elseif(!preg_match("@[0-9]@", $telephone)){
        echo "<script>alert('Invalid Telephone format');</script>";
        $error['student'] = "<div class='alert alert-danger'>Invalid Telephone format</div>";
    }
    

    if(count($error) === 0){

        $sql = "UPDATE users SET student_id=?, firstname=?, lastname=?, email=?, telephone=?, class=?, state_of_origin=?, date_of_birth=?, home_address=?, about=?, father_name=?, mother_name=?, year_of_admission=?, updated=NOW() WHERE student_id=? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssssssssssss', $staff_id, $firstname, $lastname, $email, $telephone, $class, $state_of_origin, $date_of_birth, $address, $about, $father_name, $mother_name, $year_of_admission, $staff_id);
        if($stmt->execute()){
            $message = $_SESSION['lastname'] . ' ' . $_SESSION['firstname'] . " just updated his/her profile in " . $_SESSION['class'] . " Class";
            $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES('admin',?,NOW())";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param('s', $message);
            if($notification_stmt->execute()){
               echo "<script>location.href = 'student-saved.php';</script>";
            exit();
            }
        } else{
            "error";
        }
    }
    
}