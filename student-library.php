
<?php
require "student-header.php"; 

?>

<div class="row justify-content-center">

<!-- Left side columns -->
<div class="col-lg-4">

<div class="container mt-5 pt-4">

  <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="student-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Download Pdf</a></li>
                </ol>
  </nav>

</div>
</div>
</div>

  <main id="main" class="main mt-0 pt-0">

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

          <?php
          $staff_id = $_SESSION['student'];
          $class = $row['class'];
          $sql = "SELECT * FROM users WHERE student_id=? AND admin_verify='1'";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('s', $staff_id);
          $stmt->execute();
          $result = $stmt->get_result();
          if($result->num_rows > 0){

            $sql = "SELECT * FROM library WHERE class='$class' ORDER BY library_id DESC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0){
              while($fetch = $result->fetch_assoc()){
                $teacher_id = $fetch['staff_id'];
                $sql = "SELECT * FROM staff WHERE unique_id='$teacher_id'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
               $result_row = $stmt->get_result();
               if($result_row->num_rows > 0){
              $fetch_row = $result_row->fetch_assoc();
          
      echo '
<div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

                    <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i>Profile</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-send"></i>Message</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-telephone-outbound"></i>Call</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title"><a class="nav-link nav-profile d-flex align-items-center pt-0" href="#" data-bs-toggle="dropdown">
                    <img style="height: 40px; width: 40px;" src="uploads/'.$fetch_row['image'].'" alt="Profile" class="rounded-circle">
                    <span class="d-md-block ps-2">'.$fetch_row['lastname'].' '. $fetch_row['firstname']. '</span>
                  </a><!-- End Profile Iamge Icon --></h5>

                  <div class="row g-0 text-center">
                    <h3 class="card-title fw-bold pt-0"><i class="bi bi-card-heading fs-5"></i> '.$fetch['course'].'</h3>
                    <p class="card-text pt-0">'.$fetch['about'].'</p>
                    <hr>
                 
                  <div class="row">
                    <div class="col-sm-12 d-flex align-items-center justify-content-between">
                      <a href="view-library.php?library_id='.$fetch['library_id'].'" class="btn btn-success form-control" style="border-radius: 15px;">See Book</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      ';

        } } } 
        else{
          echo "<div class='text-center py-1 text-danger fs-5 fw-bold'>
          <i class='bi bi-emoji-frown text-danger' style='font-size: 2.5rem;'></i><br />No Book Found</div>";
        }} else{
          ?>

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
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

         
        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

</div>
</div>

  <?php require "main-footer.php"; ?>