<?php require "main-header.php"; 
require "backend/staff-result-checker.php";
?>

<?php
if(isset($_GET['student_id'])){
    $student_id = $_GET['student_id'];
}

$student_sql = "SELECT * FROM users WHERE student_id='$student_id'";
$student_stmt = $conn->prepare($student_sql);
$student_stmt->execute();
$student_result = $student_stmt->get_result();
if($student_result->num_rows > 0){
  $fetch_student = $student_result->fetch_assoc();
} 
?>

<div class="container mt-5 pt-4 text-center">
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Manage Result <i class="bi bi-receipt-cutoff" style="font-size: 1.2rem;"></i></a></li>
                </ol>
  </nav>

<?php
          $staff_id = $_SESSION['staff'];
          $sql = "SELECT * FROM staff WHERE unique_id=? AND admin_verify='1'";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('s', $staff_id);
          $stmt->execute();
          $result = $stmt->get_result();
          if($result->num_rows > 0){
            ?>

</div>

<main class="main">

<section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-4">

          <div class="card text-center">
            <div class="card-body">
            <div class="text-center py-2">
              <i class="bi bi-exclamation-circle text-success" style="font-size: 2.5rem;"></i>
              </div>
              <p class="py-2">To Manage <span class="text-success fw-bold"><?= $fetch_student['lastname']; ?></span> result you have to select the term and session you wish to check</p>

              <!-- General Form Elements -->
              <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

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
                        <div class="text-danger mt-2">
                        <?php
                        if(isset($error['term'])){
                          echo $error['term'];
                        }
                        ?>
                        </div>
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
                        <div class="text-danger mt-2">
                        <?php
                    if(isset($error['section'])){
                      echo $error['section'];
                    }
                    ?>
                        </div>
                  </div>
                </div> 

                <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">

                <div class="row mb-3">
                  <div class="col-sm-12">
                   <button class="btn btn-success w-100" name="check-result">Check Result</button>
                   <div class="text-danger">
                      <?php
                    if(isset($error['result'])){
                      echo $error['result'];
                    }
                      ?>
                    </div>
                  </div>
                </div> 

              </form><!-- End General Form Elements -->
              
              <?php

            } else{
          ?>

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">

                  <div class="row g-0">
                    <div class="col-lg-4">
                      <img  src="./assets/img/florieren/logout4.jpeg" class="img-fluid rounded-start img-responsive" style="width: 100%;" alt="...">
                    </div>
                    <p class="card-text pt-3">Hi <span style="color: green;"><?php echo $row['lastname']; ?></span>, Great Kings Academy welcomes you to this platform, it is no news that the world is going digital and we have also decided to also go digital and we employ every staff to join us with this new development. <br />
                  <span class="text-danger">News and updates will be passed acrossed through this medium after the admin has verified your account</span>. 
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
      </div>
    </section>

  </main><!-- End #main -->


<?php require "main-footer.php"; ?>