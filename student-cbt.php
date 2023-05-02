
<?php
require "student-header.php"; 

?>

<div class="container mt-5 pt-4">

  <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="student-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Cbt Test</a></li>
                </ol>
  </nav>

</div>
<?php

$class = $row['class'];
$course = $_SESSION['test-course'];

if(isset($_POST['cbt-btn'])){
   if(!empty($_POST['option'])){
    $count = count($_POST['option']);
    $selected = $_POST['option'];
    $result = 0;
    
    $check_sql = "SELECT * FROM cbt WHERE class='$class' AND course='$course' ORDER BY cbt_id DESC";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->execute();
    $cresult = $check_stmt->get_result();
    if($cresult->num_rows > 0){
      while($fetch = $cresult->fetch_assoc()){


    $c = $selected[$fetch['cbt_id']];
    $c_id = $fetch['cbt_id'];
    $student_course = $fetch['course'];
    $_SESSION['student_course'] = $student_course;
    $student_class = $row['class'];
    $student_id = $row['student_id'];
    
    $cbt_sql = "INSERT INTO student_answer(student_pick, cbt_id, course, class, student_id) VALUES('$c', '$c_id', '$student_course', '$student_class', '$student_id')";
            $cbt_stmt = $conn->prepare($cbt_sql);
            if($cbt_stmt->execute()){
              echo "<script>location.href = 'cbt-result.php';</script>";
            }        
   
  }
  
}

} else {
  $result = 0;
}
echo $result;
}

?>
  <main id="main" class="main mt-0 pt-0">

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-6">
          <div class="row">
             <!-- Floating Labels Form -->
        <form class="row g-3" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

          <?php
          $num = 0; 
          $staff_id = $_SESSION['student'];
          $sql = "SELECT * FROM users WHERE student_id=? AND admin_verify='1'";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('s', $staff_id);
          $stmt->execute();
          $result = $stmt->get_result();
          if($result->num_rows > 0){

            $sql = "SELECT * FROM cbt WHERE class='$class' AND course='$course' ORDER BY cbt_id DESC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0){
              while($fetch = $result->fetch_assoc()){
                $num += 1;
                $teacher_id = $fetch['staff_id'];
                $sql = "SELECT * FROM staff WHERE unique_id='$teacher_id'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
               $result_row = $stmt->get_result();
               if($result_row->num_rows > 0){
              $fetch_row = $result_row->fetch_assoc();
          
      ?>
      <div class="card">
      <div class="card-body">
        <h5 class="card-title text-center">Question <?= $num; ?></h5>


          <div class="col-12">
            <div class="form-floating">
              <h4 class="text-center"><?= $fetch['question']; ?></h4>
            </div>
          </div>
          <div class="col-md-6">
            <div class="d-flex">
              <input type="radio" name="option[<?= $fetch['cbt_id']; ?>]" id="option1" value="<?= $fetch['option1']; ?>" />
              <label for="option1" class="ms-3"><?= $fetch['option1']; ?></label>
            </div>
          </div>
          <div class="col-md-6">
          <div class="d-flex">
              <input type="radio" name="option[<?= $fetch['cbt_id']; ?>]" id="option2" value="<?= $fetch['option2']; ?>" />
              <label for="option2" class="ms-3"><?= $fetch['option2']; ?></label>
            </div>
          </div>
          <div class="col-md-6">
          <div class="d-flex">
              <input type="radio" name="option[<?= $fetch['cbt_id']; ?>]" id="option3" value="<?= $fetch['option3']; ?>" />
              <label for="option3" class="ms-3"><?= $fetch['option3']; ?></label>
            </div>
          </div>
          <div class="col-md-6">
          <div class="d-flex">
              <input type="radio" name="option[<?= $fetch['cbt_id']; ?>]" id="option4" value="<?= $fetch['option4']; ?>"/>
              <label for="option4" class="ms-3"><?= $fetch['option4']; ?></label>
            </div>
  
          </div>
        

      </div>
    </div>
    
      <?php

        } }
    ?>
    <div class="text-center">
            <button type="submit" name="cbt-btn" style="border-radius: 15px;" class="btn btn-success form-control">Submit test</button>
          </div>
        </form><!-- End floating Labels Form -->

        <?php
    
    } 
        else{
          echo "<div class='text-center py-1 text-danger fs-5 fw-bold'>
          <i class='bi bi-x-circle text-danger' style='font-size: 2.5rem;'></i><br />No Cbt Test</div>";
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
                    <p class="card-text pt-3">Hi <span style="color: green;"><?php echo $row['lastname']; ?></span>, Great Kings Academy welcomes you to this platform, it is no news that the world is going digital and we have also decided to join the trend and we employ every Parent to join us with this new development. <br />
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

  <?php require "main-footer.php"; ?>