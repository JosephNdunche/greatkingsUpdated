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
    $_SESSION['class'] = $fetch_data['class'];
}
?>


