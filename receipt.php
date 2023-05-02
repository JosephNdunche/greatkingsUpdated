
<?php
require "student-header.php";
?>
<?php
 
 $student_id = $_SESSION['student'];
 $sql = "SELECT * FROM users where student_id=?";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param('s', $student_id);
 $stmt->execute();
 $result = $stmt->get_result();
 $fetch = $result->fetch_assoc();
?>

<section class="py-4 mb-5">
<h1 class="text-center pt-5 text-success">Great Kings Academy</h1>
<div class="container pt-1 text-right">
    <p style="text-align: right;"> 1, Alhaji Nasiru Sikiru Street,<br /> Hilltop Estate, Aboru, Lagos State. <br />
    COMPREHENSIVE ANALYSIS OF ASSESSMENT IN THE THREE DOMAINS COGNITIVE PHYSCO-MOTOR AND AFFECTIVE
</p>
<h3 class="text-center mt-5">General Fees Receipt</h3>
<?php
if(isset($_GET['receipt'])){
    $receipt_id = $_GET['receipt'];
}
 $sql = "SELECT * FROM scratch_card WHERE student_id='$staff_id' AND scratch_card_id='$receipt_id'";
 $stmt = $conn->prepare($sql);
 $stmt->execute();
 $result = $stmt->get_result();
 if($result->num_rows > 0){
    $rows = $result->fetch_assoc();
 }
    ?>
<table class="table table-bordered mt-3">
    <tbody>
    <tr>
       <th scope="col">FULLNAME: </th>
        <th scope="col" class="text-success"><?= $fetch['lastname']; ?> <?= $fetch['firstname']; ?></th>
    </tr>
    <tr>
       <th scope="col">STUDENT ID: </th>
        <th scope="col" class="text-success"><?= $fetch['student_id']; ?></th>
    </tr>
    <tr>
       <th scope="col">CLASS: </th>
        <th scope="col" class="text-success"><?= $fetch['class']; ?></th>
    </tr>
    <tr>
       <th scope="col">ACADEMIC SESSION: </th>
        <th scope="col" class="text-success"><?= $rows['session']; ?></th>
    </tr>
    <tr>
       <th scope="col">ACADEMIC TERM: </th>
        <th scope="col" class="text-success"><?= $rows['term']; ?></th>
    </tr>
    <tr>
       <th scope="col">PAYMENT PURPOSE: </th>
        <th scope="col" class="text-success">School Fees</th>
    </tr>
    <tr>
       <th scope="col">PAYMENT AMOUNT: </th>
        <th scope="col" class="text-success"><?= $rows['transfer_amount']; ?></th>
    </tr>
    <tr>
       <th scope="col">PAYMENT MODE: </th>
        <th scope="col" class="text-success">Transfer</th>
    </tr>
    </tbody>
</table>


</div>
</section>

<?php require "main-footer.php";
