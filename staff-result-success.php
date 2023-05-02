
<?php
require "main-header.php";

$student_id = $_SESSION['student_id'];
$course = $_SESSION['course'];
$sql = "SELECT * FROM users WHERE student_id = ? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $student_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<section class="signup py-5 mt-5">
<div class="container">
<div class="text-center">
    <i class="bi bi-check-circle-fill text-success" style="font-size: 3.5rem;"></i>
    </div>
    <p class="text-center">You have successfully uploaded <span class="text-success"><?= $row['lastname']; ?> <?= $row['firstname']; ?></span> <span class="text-danger"><?php echo $course; ?></span> result</p>
    <a href="staff-checking-result.php" class="bg-success text-white form-control text-center">Continue</a>
</div>
</section>   

<?php require "main-footer.php"; ?>