<?php
require_once "database/connection.php";

$error = array();

if(isset($_POST['login-btn'])){
    
    $staff_id = trim($_POST['staff_id']);
    $staff_id = stripslashes($staff_id);
    $staff_id = htmlspecialchars($staff_id);

    $password = trim($_POST['password']);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);

    if(empty($staff_id) || empty($password)){
        $error['staff_login'] = "<div class='alert alert-danger'>Fill in all the fields</div>";
    }

    if(count($error) === 0){
        $sql = "SELECT * FROM staff WHERE unique_id = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt -> bind_param('s', $staff_id);
        $stmt -> execute();
        $result = $stmt->get_result();
        $staff = $result->fetch_assoc();

        if(password_verify(@$password, @$staff['password'])){
            $_SESSION['staff'] = $staff['unique_id'];
            $_SESSION['staff_firstname'] = $staff['firstname'];
            $_SESSION['staff_lastname'] = $staff['lastname'];
            $_SESSION['staff_email'] = $staff['email'];
            $_SESSION['staff_telephone'] = $staff['telephone'];
            $_SESSION['staff_class'] = $staff['class'];
            $_SESSION['staff_verified'] = $staff['verified'];
            header("location: dashboard.php");
            exit();
        } else{
            $error['staff_login'] = "<div class='alert alert-danger'>Credentials does not match, try again</div>";
        }
    }

    
}