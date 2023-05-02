<?php
if(isset($_GET['staff_id'])){
    $staff_id = $_GET['staff_id'];
}
$sql = "SELECT * FROM staff WHERE unique_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $staff_id);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0){
    $fetch_data = $result->fetch_assoc();
    $_SESSION['staff_lastname'] = $fetch_data['lastname'];
    $_SESSION['staff_firstname'] = $fetch_data['firstname'];
    $_SESSION['staff_class'] = $fetch_data['class'];
}
?>

