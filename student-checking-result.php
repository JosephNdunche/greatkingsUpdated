<?php
require "student-header.php";
require "backend/result-checker.php";
?>

<div class="row justify-content-center">

<!-- Left side columns -->
<div class="col-lg-4">

<section class="signup py-5 mt-4">
<div class="container">

<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="student-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Result Checker <i class="bi bi-receipt-cutoff" style="font-size: 1.2rem;"></i></a></li>
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

  $sql = "SELECT * FROM scratch_card WHERE student_id = ? AND verified = '1'";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $student_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $num_of_rows = $result->num_rows;
  if($num_of_rows > 0){
    $fetch = $result->fetch_assoc();
  }
?>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

<div class="text-center py-2">
              <i class="bi bi-exclamation-circle text-success" style="font-size: 2.5rem;"></i>
              </div>
              <p class="py-2 text-center">To Check your result, you have to select a term and a session.</p>
              <div class="text-center">
  <?php
if(isset($error['result'])){
  echo $error['result'];
}
  ?>
</div>
<div class="row mb-3">
                  <div class="col-sm-12">
                  <select name="term" id="" class="form-select" aria-label="Default select example">
                            <option value="">Select Term</option>
                      <?php
                      $sql_term = "SELECT term FROM term";
                      $term_stmt = $conn->prepare($sql_term);
                      $term_stmt->execute();
                      $term_result = $term_stmt->get_result();
                      if($term_result->num_rows > 0){
                        while($term_row = $term_result->fetch_assoc()){
                          echo '
                          <option value='.$term_row['term'].'>'.$term_row['term'].'</option>
                          ';
                        }
                      }
                      ?>
                        </select>
                  </div>
                  <div class="text-danger">
    <?php
if(isset($error['term'])){
  echo $error['term'];
}
?>
    </div>
                </div> 
                
                <div class="row mb-3">
                  <div class="col-sm-12">
                  <select name="session" id="session" class="form-select" aria-label="Default select example">
                            <option value="">Select Session</option>
                      <?php
                      $sql_session = "SELECT session FROM session";
                      $session_stmt = $conn->prepare($sql_session);
                      $session_stmt->execute();
                      $session_result = $session_stmt->get_result();
                      if($session_result->num_rows > 0){
                        while($session_row = $session_result->fetch_assoc()){
                          echo '
                          <option value='.$session_row['session'].'>'.$session_row['session'].'</option>
                          ';
                        }
                      }
                      ?>
                        </select>
                  </div>
                </div> 
 
<button type="submit" class="btn btn-success form-control bg-success" style="border-radius: 15px;" name="result-btn">Check Result</button>
  </div>
  
  
</form>

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
                    <p class="card-text pt-3">Hi <span style="color: green;"><?php echo $row['lastname']; ?></span>, Florieren Park Lane International Schools welcomes you to this platform, it is no news that the world is going digital and we have also decided to join the trend and we employ every Parent to join us with this new development. <br />
                  <span class="text-danger">You can't access anything here until the admin verifies your account. We will send you an email immediately after your account has been verified.</span>. 
                  </p>
                 
                </div>
              </div>
            </div>
          </div><!-- End Card with an image on left -->

         <?php
        
        }?>
</div>
      </div>
      </div>

<?php require "main-footer.php"; ?>