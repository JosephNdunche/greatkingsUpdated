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
        $error['admin_login'] = "<div class='alert alert-danger'>Fill in all the fields</div>";
    }

    if(count($error) === 0){
        $sql = "SELECT * FROM staff WHERE unique_id = ? AND user='admin' OR user='admin1' limit 2";
        $stmt = $conn->prepare($sql);
        $stmt -> bind_param('s', $staff_id);
        $stmt -> execute();
        $result = $stmt->get_result();
        $staff = $result->fetch_assoc();

        if(password_verify(@$password, @$staff['password'])){
            $_SESSION['admin'] = $staff['unique_id'];
            $_SESSION['admin_firstname'] = $staff['firstname'];
            $_SESSION['admin_lastname'] = $staff['lastname'];
            $_SESSION['admin_class'] = $staff['class'];
            
            header("location: admin-dashboard.php");
            exit();
        } else{
            $error['admin_login'] = "<div class='alert alert-danger'>Credentials does not match, try again</div>";
        }
    }

    
}