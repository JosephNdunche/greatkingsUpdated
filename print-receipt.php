<?php require "student-header.php"; ?>
<div class="row justify-content-center">

<style>
    i{
        color: black;
    }
</style>

<!-- Left side columns -->
<div class="col-lg-4">
<div class="container mt-5 pt-4">

<nav>
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php"><i class="bi bi-house-door"></i></a></li>
      <li class="breadcrumb-item"><a href="#">Print Receipt <i class="bi bi-people" style="font-size: 1.2rem; color: green;"></i></a></li>
              </ol>
</nav>

</div>

<?php
           $staff_id = $_SESSION['student'];
           $sql = "SELECT * FROM users WHERE student_id=? AND admin_verify='1'";
           $stmt = $conn->prepare($sql);
           $stmt->bind_param('s', $staff_id);
           $stmt->execute();
           $result = $stmt->get_result();
           if($result->num_rows > 0){

            ?>
            
            
<div class="card text-center">
            <div class="card-body pt-3">
              
                <?php 
                $error = [];
                $class = $row['class'];
            $sql = "SELECT * FROM scratch_card WHERE student_id='$staff_id' AND verified='1'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0){
              echo '
              <div class="text-center">
              <i class="bi bi-exclamation-circle text-success" style="font-size: 2.5rem;"></i>
              </div>
              <p>You can print all your receipts here.</p>
                <table class="table table-bordered mt-3">
                <thead>
                  <tr>
                    <th scope="col"><i class="bi bi-link"></i></th>
                    <th scope="col"><i class="bi bi-currency-dollar
                    "></i></th>
                    <th scope="col"><i class="bi bi-clock"></i></th>
                    <th scope="col"><i class="bi bi-printer"></i></th>
                  </tr>
                </thead>
                <tbody>
                ';
              while($fetch = $result->fetch_assoc()){
                echo '
                <tr>
                    <th scope="col">School Fees</th>
                    <td>'.$fetch['transfer_amount'].'</td>
                    <td>'.$fetch['transfer_date'].'</td>
                    <td><a href="receipt.php?receipt='.$fetch['scratch_card_id'].'">Print</a></td>
                  </tr>
                ';
              }
            ?>
           
                  
                </tbody>
              </table>
              <!-- End Bordered Table -->

              </div><!-- End Card with an image on left -->
            </div>
              <?php 
             } else{
                $error['error'] = "<div class='text-center py-1 text-danger fs-5 fw-bold'>
                <i class='bi bi-x-circle text-danger' style='font-size: 2.5rem;'></i><br />No Receipt</div>";
              }

?>
<?php
            } else{
              ?>

 <!-- Sales Card -->
 <div class="row justify-content-center">
 <div class="col-md-12 mt-5">
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
                    <p class="card-text pt-3">Hi <span style="color: green;"><?php echo $row['lastname']; ?></span>, Florieren Park Lane International Schools welcomes you to this platform, it is no news that the world is going digital and we have also decided to join the trend and we employ every Parent to join us with this new development. <br />
                  <span class="text-danger">You can't access anything here until the admin verifies your account. We will send you an email immediately after your account has been verified.</span>. 
                  </p>
                 
                </div>
              </div>
            </div>
          </div><!-- End Card with an image on left -->
      
              <?php
            }
?>
<div class="text-danger text-center mb-3">
  <?php
                        if(isset($error['error'])){
                          echo $error['error'];
                        }
                        ?>
  </div>
                      </div>

</div>
</div>
<?php require "main-footer.php"; ?>
