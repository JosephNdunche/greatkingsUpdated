<?php require "student-header.php"; 
require "backend/school-fees.php";
?>

<section class="signup py-5 mt-4">

<div class="row justify-content-center">
    <div class="col-lg-4">

<div class="container">
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="student-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">School Fees <i class="bi bi-receipt-cutoff" style="font-size: 1.2rem;"></i></a></li>
                </ol>
  </nav>
  
  <?php
          $staff_id = $_SESSION['student'];
          $sql = "SELECT * FROM users WHERE student_id=? AND admin_verify='1'";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('s', $staff_id);
          $stmt->execute();
          $result = $stmt->get_result();
          if($result->num_rows > 0){
            ?>

<?php
$sql1 = "SELECT * FROM account";
$stmt1 = $conn->prepare($sql1);
$stmt1->execute();
$result1 = $stmt1->get_result();
if($result1->num_rows > 0){
  $row1 = $result1->fetch_assoc();
}
?>
                   <h3 class="mt-5 fw-bold mb-3 text-success">Pay Now</h3>
              <?php
                      $fees_sql = "SELECT * FROM manage_fees_tbl";
                      $fees_stmt = $conn->prepare($fees_sql); 
                      $fees_stmt->execute();
                      $fees_result = $fees_stmt->get_result();
                      if($fees_result->num_rows > 0){
                          $get_fees_result = $fees_result->fetch_assoc();
                      }
                      if($row['class'] === 'Jss-1' || $row['class'] === 'Jss-2' || $row['class'] === 'Jss-3'){
                      $fees = $get_fees_result['manage_junior_fees'];
                      } else{
                        $fees = $get_fees_result['manage_senior_fees'];
                      }
                      if($fees === ''){
                        $fees = 0;
                      }

?>
<p>Dear <span class="text-success"><?php echo $_SESSION['lastname']; ?></span>: <br /> you can pay twice at a ratio of 40% - 60%. e.g the ratio of 40% of <span class="text-success fw-bold"><?= $fees; ?></span> is  <span class="text-success fw-bold"><?= $fees * 0.4; ?></span> and 60% is  <span class="text-success fw-bold"><?= $fees * 0.6; ?></span>. click the button below to see account details, then make payment and take a screen shot of the payment and upload below.</p>

 <!-- Basic Modal -->
<div class="pt-2">
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
                        Amount to pay: <span class="text-success"><?= $fees; ?></span><br />
                        Account Name: <span class="text-success"><?php echo $row1['account_name'];  ?></span> <br />
                        Account Number: <span class="text-success"><?php echo $row1['account_number'];  ?></span> <br />
                        Account Bank: <span class="text-success"><?php echo $row1['account_bank'];  ?></span> <br />
                        </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Basic Modal-->


              <div class="container text-center mt-5">
                <img src="./assets/img/greatkings/pay2.jpeg" style="height : 16rem;" class="img-fluid" alt="">
              </div>
              
  <h4 class="mt-5 text-success pt-3">Upload Receipt</h4>
  <p class="pb-3">The screenshot should look exactly like the one above.</p>
            
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
<div class="text-center">
    <?php
if(isset($error['file'])){
  echo $error['file'];
}
?>
  </div>
<label for="amount">Transfer Amount</label>
    <input type="tel" name="amount" id="amount" class="form-control bor" placeholder="Enter Transfer Amount">

    <label for="file" class="mt-3">upload screenshot of Payment</label>
    <input type="file" name="file" id="file" class="form-control">

  <label for="date" class="mt-3">Transfer Date</label>
    <input type="date" name="date" id="date" class="form-control" placeholder="Enter Transfer Date">

    <button name="school-fees-btn" type="submit" class="btn btn-success mt-4 bg-success text-white mt-2">Upload Here</button>
</form>
</p>
</div>
</div>
    </div>
</section>

   <?php

            } else{
          ?>

            <!-- Sales Card -->
            <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="card info-card sales-card">

                <div class="card-body">

                  <div class="row g-0">
                    <div class="col-lg-4">
                      <!-- Slides with controls -->
              <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                  <img  src="./assets/img/florieren/blog1.jpg" class="img-fluid rounded-start img-responsive mt-3" style="width: 100%;" alt="...">
                  </div>
                  <div class="carousel-item">
                  <img  src="./assets/img/florieren/blog3.jpg" class="img-fluid rounded-start img-responsive mt-3" style="width: 100%;" alt="...">
                  </div>
                  <div class="carousel-item">
                  <img  src="./assets/img/florieren/blog4.jpg" class="img-fluid rounded-start img-responsive mt-3" style="width: 100%;" alt="...">
                  </div>
                  <div class="carousel-item">
                  <img  src="./assets/img/florieren/event4.jpg" class="img-fluid rounded-start img-responsive mt-3" style="width: 100%;" alt="...">
                  </div>
                  <div class="carousel-item">
                  <img  src="./assets/img/florieren/event1.jpg" class="img-fluid rounded-start img-responsive mt-3" style="width: 100%;" alt="...">
                  </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>

              </div><!-- End Slides with controls -->
                    </div>
                    <p class="card-text pt-3">Hi <span style="color: green;"><?php echo $row['lastname']; ?></span>, Great Kings Academy welcomes you to this platform, it is no news that the world is going digital and we have also decided to join the trend and we employ every Parent to join us with this new development. <br />
                  <span class="text-danger">You can't access anything here until the admin verifies your account. We will send you an email immediately after your account has been verified.</span>. 
                  </p>
                 
                </div>
              </div>
            </div>
          </div><!-- End Card with an image on left -->

         <?php
        
        }?>



<?php require "main-footer.php"; ?>