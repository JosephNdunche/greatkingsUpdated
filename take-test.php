<?php
require "student-header.php";
?>

<div class="container mt-5 pt-5">

  <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="student-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Take Test</a></li>
                </ol>
  </nav>

</div>

<main id="main" class="main mt-0">

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-6">

          

            <?php
             if(isset($_GET['cbt_id'])){
              $cbt_id = $_GET['cbt_id'];
             }
             $sql = "SELECT * FROM  cbt WHERE cbt_id='$cbt_id'";
             $stmt = $conn->prepare($sql);
             $stmt->execute();
             $result = $stmt->get_result();
             if($result->num_rows > 0){
               $get_data = $result->fetch_assoc();
               $staff_id = $get_data['staff_id'];
               $sql1 = "SELECT * FROM  staff WHERE unique_id='$staff_id'";
               $stmt1 = $conn->prepare($sql1);
             $stmt1->execute();
             $get = $stmt1->get_result();
             if($get->num_rows > 0){
               $data = $get->fetch_assoc();

             }

              
             }
             ?>
            
            <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Question <?= $_SESSION['amount']; ?></h5>

              <!-- Floating Labels Form -->
              <form class="row g-3" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">

                <div class="col-12">
                  <div class="form-floating">
                    <textarea class="form-control" name="question" placeholder="Address" id="floatingTextarea" style="height: 100px;"></textarea>
                    <label for="floatingTextarea">Enter Question Here</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" name="q1" class="form-control" id="floatingEmail" placeholder="Your Email">
                    <label for="floatingEmail">Option one</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" name="q2" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Option Two</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" name="q3" class="form-control" id="floatingEmail" placeholder="Your Email">
                    <label for="floatingEmail">Option Three</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" name="q4" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Option Four</label>
                  </div>
        
                </div>
                <div class="form-floating">
                    <input class="form-control" name="answer" placeholder="Address" type="text" id="floatingTextarea" />
                    <label for="floatingTextarea">Enter Answer Here</label>
                  </div>
                 
                <div class="text-center">
                  <button type="submit" name="cbt-btn" class="btn btn-success form-control">Continue</button>
                </div>
              </form><!-- End floating Labels Form -->

            </div>
          </div>
          


        </div>
      </div>
    </section>

  </main><!-- End #main -->

<?php
require "main-footer.php";
?>