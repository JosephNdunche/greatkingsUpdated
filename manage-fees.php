<?php require "admin-header.php";
require "backend/manage-fees.php";
?>

<div class="container mt-5 pt-5">

<div class="row justify-content-center">

  <div class="col-lg-4">

  <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="admin-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Manage School Fees Amount<i class="bi bi-people" style="font-size: 1.2rem; color: green;"></i></a></li>
                </ol>
  </nav>

            
<div class="card text-center">
            <div class="card-body pt-3">
              <div class="text-center">
              <i class="bi bi-exclamation-circle text-success" style="font-size: 2.5rem;"></i>
              </div>
              <p>Insert the current fees.</p>

              <div class="text-danger pt-3">
              <?php
              if(isset($error['fees'])){
                 echo $error['fees'];
               }
               ?>
              </div>
                
              <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
              <div class="mb-3 mt-3">
                <input type="text" id="junior" placeholder="Enter Junior Fees Amount" name="junior" class="form-control">
                
                </div>
                <div class="mb-3 mt-3">
                <input type="text" id="senior" placeholder="Enter Senior Fees Amount" name="senior" class="form-control">
                </div>
  
  <button type="submit" class="btn btn-primary form-control bg-success" name="manage-fees">Manage School Fees</button>
</form>
              </form>
         </div>
    </div>
  </div>
</div>
                           

<?php require "main-footer.php"; ?>
