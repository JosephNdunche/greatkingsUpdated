<?php require "main-header.php"; ?>
<?php
     $_SESSION['amount'] = $_SESSION['amount'] - 1;
     if($_SESSION['amount'] === 0){
        echo "<script>location.href = 'cbt-success.php';</script>";
     }
?>

<?php
  if(isset($_POST['cbt-btn'])){

    $question = $_POST['question'];
    $q1 = $_POST['q1'];
    $q2 = $_POST['q2'];
    $q3 = $_POST['q3'];
    $q4 = $_POST['q4'];
    $answer = $_POST['answer'];

     $staff_id = $_SESSION['staff'];
     $time = $_SESSION['time'];
     $course = $_SESSION['course'];
     $class =  $_SESSION['class'];
     $sql = "INSERT INTO cbt(staff_id, class, course, question, option1, option2, option3, option4, answer, time_frame, date) VALUES(?,?,?,?,?,?,?,?,?,?,NOW())";
     $stmt = $conn->prepare($sql);
     $stmt->bind_param('ssssssssss', $staff_id, $class, $course, $question, $q1, $q2, $q3, $q4, $answer, $time);
     if($stmt->execute()){
        echo "inserted";
     } else {
        echo "not inserted";
     }
    
  }

?>
<section class="section mt-5 pt-5">
      <div class="row justify-content-center">
        <div class="col-lg-4">

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


<?php require "main-footer.php"; ?>