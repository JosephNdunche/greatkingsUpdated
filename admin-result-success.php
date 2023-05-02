<?php
require "admin-header.php";

$student_id = $_SESSION['student_id'];
$course = $_SESSION['course'];
$sql = "SELECT * FROM users WHERE student_id = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $student_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<section class="signup pt-5 mt-5">
<div class="text-center">
        <i class="bi bi-check-circle-fill" style="font-size: 3rem; color: green;"></i>
        </div>
<div class="container">
    <p>You have successfully updated <span class="text-success"><?php echo $row['lastname']; ?> <?php echo $row['firstname']; ?></span> <span class="text-danger"><?php echo $course; ?></span> result</p>
    <a href="admin-checking-result.php" class="bg-success text-white form-control text-center">Continue</a>
</div>
</section>   

<?php require "main-footer.php"; ?>