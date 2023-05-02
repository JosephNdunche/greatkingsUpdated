<?php require "main-header.php"; ?>

<div class="container mt-4 pt-5">

<div class="row justify-content-center">
  <div class="col-lg-4">

<nav>
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php"><i class="bi bi-house-door"></i></a></li>
      <li class="breadcrumb-item"><a href="#">Upload Result <i class="bi bi-people" style="font-size: 1.2rem; color: green;"></i></a></li>
              </ol>
</nav>


<?php
          $staff_id = $_SESSION['staff'];
          $class = $row['class'];
          $sql = "SELECT * FROM staff WHERE unique_id=? AND admin_verify='1' AND class=?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('ss', $staff_id, $class);
          $stmt->execute();
          $result = $stmt->get_result();
          if($result->num_rows > 0){

            ?>
            
<div class="card text-center">
            <div class="card-body pt-2">
            <div class="text-center">
              <i class="bi bi-exclamation-circle text-success" style="font-size: 2.5rem;"></i>
              </div>
              <p>You can only Upload the result of <span class="text-success fw-bold"><?php echo $row['class']; ?></span> class because you are their class teacher.</p>

              </div><!-- End Card with an image on left -->
            </div>
              
                <?php 
                $error = [];
                $class = $row['class'];
            $sql = "SELECT * FROM users WHERE admin_verify='1' AND class='$class'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0){
              echo '
                <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">image</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                ';
              while($fetch = $result->fetch_assoc()){
                echo '
                <tr>
                    <td><img style="height: 70px; width: 70px;" src="uploads/'.$fetch['image'].'" class="img-fluid" /></td>
                    <td>'.$fetch['lastname'].'</td>
                    <td>'.$fetch['firstname'].'</td>
                    <td><a href="upload-student-result.php?student_id='.$fetch['student_id'].'"><i class="bi bi-box-arrow-up fs-5" style="color: green;"></i></a></td>
                  </tr>
                ';
              }
            ?>
           
                  
                </tbody>
              </table>
              <!-- End Bordered Table -->
              <?php 
             } else{
                $error['error'] = "<div class='text-center py-1 text-danger fs-5 fw-bold'>
                <i class='bi bi-x-circle text-danger' style='font-size: 2.5rem;'></i><br />No New Student Found</div>";
              }

?>
  </div>
</div>
</div>
<?php
            } else{
              ?>

 <!-- Sales Card -->
 <div class="row justify-content-center">
 <div class="col-xxl-4 col-md-6 mt-5">
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
                    <p class="card-text pt-3">Hi <span style="color: green;"><?php echo $row['lastname']; ?></span>, Great Kings Academy welcomes you to this platform, it is no news that the world is going digital and we have also decided to join the trend and we employ every Staff to join us with this new development. <br />
                  <span class="text-danger">You can't access anything here until the admin verifies your account. We will send you an email immediately after your account has been verified.</span>. 
                  </p>
                 
                </div>
              </div>
            </div>
      
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

<?php require "main-footer.php"; ?>
