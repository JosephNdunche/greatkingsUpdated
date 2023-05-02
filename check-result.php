
<?php
require "student-header.php";
require "backend/check-scratchcard.php";
?>

<section class="signup py-5 mt-4">
<div class="container">

<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="student-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Result Checker <i class="bi bi-receipt-cutoff" style="font-size: 1.2rem;"></i></a></li>
                </ol>
  </nav> 



<div class="text-center py-2">
              <i class="bi bi-exclamation-circle text-success" style="font-size: 2.5rem;"></i>
              </div>
<p class="text-center"><span><span class="text-success"><?php echo $_SESSION['lastname']; ?></span>, Your payment is under review, check back later.</span>.</p>
<a href="student-dashboard.php" class="btn btn-success form-control">Go to Dashboard</a>

</div>
</section>

    
</div>




<?php require "main-footer.php"; ?>



