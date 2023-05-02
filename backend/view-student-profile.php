<?php
if(isset($_GET['student_id'])){
    $student_id = $_GET['student_id'];
}
$sql = "SELECT * FROM users WHERE student_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $student_id);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0){
    $fetch_data = $result->fetch_assoc();
    $_SESSION['lastname'] = $fetch_data['lastname'];
    $_SESSION['firstname'] = $fetch_data['firstname'];
}
?>

<?php

if(isset($_POST['delete-student'])){
    $student_id = $_POST['student_id'];
    $sql = "DELETE FROM users WHERE student_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $student_id);
    if($stmt->execute()){
        $message = "A staff by the name " . $_SESSION['admin_lastname'] . ' ' . $_SESSION['admin_firstname'] . " just Deleted " . $fetch_data['lastname'] . " " . $fetch_data['firstname'] . " Records " . $fetch_data['class'] . " Class";
            $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
            $admin_id = "admin";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param('ss', $admin_id, $message);
            if($notification_stmt->execute()){
        header("location: deleted.php");
    }
}
}
?>