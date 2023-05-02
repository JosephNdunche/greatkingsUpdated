<?php
require "database/connection.php";

$error = array();

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

    $staff_id = $_SESSION['staff'];

    if(empty($firstname) || empty($lastname) || empty($email) || empty($telephone) || empty($class) || empty($state_of_origin) || empty($date_of_birth) || empty($address) || empty($about)){
        echo "<script>alert('No field should be empty');</script>";
        $error['edit'] = "<div class='alert alert-danger'>No field should be empty</div>";
    } 

    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<script>alert('Invalid email format');</script>";
        $error['edit'] = "<div class='alert alert-danger'>Invalid email format</div>";
    }

    elseif(!preg_match("@[0-9]@", $telephone)){
        echo "<script>alert('Invalid Telephone format');</script>";
        $error['edit'] = "<div class='alert alert-danger'>Invalid Telephone format</div>";
    }
    

    if(count($error) === 0){

        $sql = "UPDATE staff SET unique_id=?, firstname=?, lastname=?, email=?, telephone=?, class=?, state_of_origin=?, date_of_birth=?, home_address=?, about=?, updated=NOW() WHERE unique_id=? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssssssss', $staff_id, $firstname, $lastname, $email, $telephone, $class, $state_of_origin, $date_of_birth, $address, $about, $staff_id);
        if($stmt->execute()){
            $admin_id = 'admin';
            $message = $_SESSION['staff_lastname'] . ' ' . $_SESSION['staff_firstname'] . " just updated his/her profile in " . $class . ' Class';
            $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param('ss', $admin_id, $message);
            if($notification_stmt->execute()){
              echo "<script>location.href = 'saved.php';</script>";
            exit();
            }
        } else{
            $error['edit'] = "<div class='alert alert-danger'>error</div>";
        }
    }
    
}