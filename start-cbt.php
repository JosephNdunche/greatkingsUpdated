<?php require "student-header.php"; 
require "backend/school-fees.php";
?>

<div class="row justify-content-center">

<!-- Left side columns -->
<div class="col-lg-4">

<section class="signup py-5 mt-4">

<?php
$error = [];
if(isset($_POST['start-test'])){

     $course = $_POST['course'];
     $class = $row['class'];

     $sql = "SELECT * FROM cbt WHERE course=? AND class=?";
     $stmt = $conn->prepare($sql);
     $stmt->bind_param('ss', $course, $class);
     $stmt->execute();
     $result = $stmt->get_result();
     if($result->num_rows > 0){
        $_SESSION['test-course'] = $course;
        echo "<script>location.href = 'student-cbt.php';</script>";

     } else {
        echo "<script>alert('No Test, check later');</script>";
     }
}

?>

<div class="container">
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="student-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Start Test <i class="bi bi-receipt-cutoff" style="font-size: 1.2rem;"></i></a></li>
                </ol>
  </nav>
  </div>
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
            <div class="row justify-content-center container">

             <div class="col-lg-4">

            <img src="./assets/img/greatkings/student.png" class="img-fluid" alt="">
            <h3 class="mt-5 fw-bold mb-3">Hi, <span class="text-success"><?php echo $_SESSION['lastname']; ?></span></h3>

            <p>You are about to write a test, before starting the test, make sure you are ready, because, there's a timer and once the time is out, it logs you off.<br /><br />
        Ready for the test? <br />
        </p>
</div>
 </div>

      <div class="container">
      <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
       <div class="row mb-3 justify-content-center">
                  <div class="col-lg-4">
                  <select name="course" id="course" class="form-select" aria-label="Default select example">
                            <option value="<?php if(isset($course)){
                        echo $course;
                      }else{
                        echo "";
                      } ?>"><?php if(isset($course)){
                        echo $course;
                      }else{
                        echo "Select Course";
                      } ?></option>
                      <?php
                      $sql_course = "SELECT courses FROM course";
                      $course_stmt = $conn->prepare($sql_course);
                      $course_stmt->execute();
                      $course_result = $course_stmt->get_result();
                      if($course_result->num_rows > 0){
                        while($course_row = $course_result->fetch_assoc()){
                          echo '
                          <option value='.$course_row['courses'].'>'.$course_row['courses'].'</option>
                          ';
                        }
                      }
                      ?>
                        </select>
                        
                  </div>
                </div> 

                <div class="row mb-3 justify-content-center">
                  <div class="col-lg-4">
                    <button class="btn btn-success w-100" name="start-test">Start Test</button>
                  </div>
                </div>


          </form>
      </div>
</div>
</div>


   <?php

            } else{
          ?>

            <!-- Sales Card -->
            <div class="row justify-content-center">
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
</div>
</section>



<?php require "main-footer.php"; ?>