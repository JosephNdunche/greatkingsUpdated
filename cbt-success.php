
<?php
require "main-header.php";
?>

<section class="signup py-5 mt-5">
<div class="container">
<div class="text-center">
    <i class="bi bi-check-circle-fill text-success" style="font-size: 3.5rem;"></i>
    </div>
    <p class="text-center">You have successfully uploaded <span class="text-success"><?= $_SESSION['class']; ?></span> class <span class="text-success"><?= $_SESSION['course']; ?></span> test </p>
    <a href="dashboard.php" class="bg-success text-white form-control text-center">Continue</a>
</div>
</section>   

<?php require "main-footer.php"; ?>