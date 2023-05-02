<?php
require_once "database/connection.php";

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

    $staff_id = $_SESSION['admin'];

    if(empty($firstname)){
        $error['firstname'] = "This field cannot be empty";
    } 

    if(empty($lastname)){
        $error['lastname'] = "This field cannot be empty";
    } 

    if(empty($email)){
        $error['email'] = "This field cannot be empty";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error['email'] = "Invalid email format";
    }

    if(empty($telephone)){
        $error['telephone'] = "This field cannot be empty";
    } elseif(!preg_match("@[0-9]@", $telephone)){
        $error['telephone'] = "Invalid Telephone format";
    }

    if(empty($class)){
        $error['class'] = "This field cannot be empty";
    }

    if(empty($state_of_origin)){
        $error['state_of_origin'] = "This field cannot be empty";
    }

    if(empty($date_of_birth)){
        $error['date_of_birth'] = "This field cannot be empty";
    }

    if(empty($address)){
        $error['address'] = "This field cannot be empty";
    }

    if(empty($about)){
        $error['about'] = "This field cannot be empty";
    }
    

    if(count($error) === 0){

        $sql = "UPDATE staff SET unique_id=?, firstname=?, lastname=?, email=?, telephone=?, class=?, state_of_origin=?, date_of_birth=?, home_address=?, about=?, updated=NOW() WHERE unique_id=? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssssssss', $staff_id, $firstname, $lastname, $email, $telephone, $class, $state_of_origin, $date_of_birth, $address, $about, $staff_id);
        if($stmt->execute()){
            $message = "You have successfully updated your profile";
            $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param('ss', $staff_id, $message);
            if($notification_stmt->execute()){
            header("location: admin-saved.php");
            exit();
            }
        } else{
            "error";
        }
    }
    
}