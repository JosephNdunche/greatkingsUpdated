<?php require "student-header.php"; 
require "backend/payment.php";
?>

<section class="signup py-5 mt-4">

<div class="container">
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="student-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Buy Scratch Card <i class="bi bi-receipt-cutoff" style="font-size: 1.2rem;"></i></a></li>
                </ol>
  </nav>

<?php
$sql = "SELECT * FROM account";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0){
  $row = $result->fetch_assoc();
}
?>

<div class="text-center py-2">
              <i class="bi bi-exclamation-circle text-danger" style="font-size: 2.5rem;"></i>
              </div>
<p class="text-center">Dear <span class="text-success"><?php echo $_SESSION['lastname']; ?></span>, click the button below to see account details, then make payment and take a screen shot of the payment and upload below.</p>

 <!-- Basic Modal -->
<div class="text-center">
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#basicModal">
                Account Details
              </button>
</div>
              <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Account Details</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>
                        Amount to pay: <span class="text-success">700</span><br />
                        Account Name: <span class="text-success"><?php echo $row['account_name'];  ?></span> <br />
                        Account Number: <span class="text-success"><?php echo $row['account_number'];  ?></span> <br />
                        Account Bank: <span class="text-success"><?php echo $row['account_bank'];  ?></span> <br />
                        </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Basic Modal-->


              <h4 class="mt-5 text-success text-center py-3">Upload Receipt</h4>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
<label for="amount">Transfer Amount</label>
    <input type="tel" name="amount" id="amount" class="form-control" placeholder="Enter Transfer Amount">
    <div class="text-danger">
    <?php
if(isset($error['amount'])){
  echo $error['amount'];
}
?>
  </div>

    <label for="file" class="mt-3">upload screenshot of Payment</label>
    <input type="file" name="file" id="file" class="form-control">
    <div class="text-danger">
    <?php
if(isset($error['file'])){
  echo $error['file'];
}
?>
  </div>

  <label for="date" class="mt-3">Transfer Date</label>
    <input type="date" name="date" id="date" class="form-control" placeholder="Enter Transfer Date">
    <div class="text-danger">
    <?php
if(isset($error['date'])){
  echo $error['date'];
}
?>
  </div>

    <button name="payment-btn" type="submit" class="bg-success text-white mt-2 form-control">Upload Here</button>
</form>
</p>

</section>

<?php require "main-footer.php"; ?>