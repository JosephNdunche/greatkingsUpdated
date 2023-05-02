<?php require "main-header.php"; ?>

<?php
  if(isset($_POST['cbt-btn'])){
  
    $amount = trim($_POST['amount']);
    $amount = stripslashes($amount);


    $class = trim($_POST['class']);
    $class = stripslashes($class);

    $course = trim($_POST['course']);
    $course = stripslashes($course);

    $time = trim($_POST['time']);
    $time = stripslashes($time);

    $_SESSION['amount'] = $amount;
    $_SESSION['course'] = $course;
    $_SESSION['class'] = $class;
    $_SESSION['time'] = $time;
    echo "<script>location.href = 'insert-cbt.php';</script>";
    
  }

?>
<section class="section mt-5 pt-5">
      <div class="row justify-content-center">
        <div class="col-lg-4">

        <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Select how many Questions</h5>

              <!-- Floating Labels Form -->
              <form class="row g-3" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>"method="POST" >

                <div class="col-12">
                  <div class="form-floating">
                    <select name="amount" id="" class="form-control">
                      <option value="2">1</option>
                      <option value="3">2</option>
                      <option value="4">3</option>
                      <option value="5">4</option>
                      <option value="6">5</option>
                      <option value="7">6</option>
                      <option value="8">7</option>
                      <option value="9">8</option>
                      <option value="10">9</option>
                      <option value="11">10</option>
                    </select>
                    <label for="floatingTextarea">How many questions?</label>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-floating">
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
                        
                    <label for="floatingTextarea">How many questions?</label>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-floating">
                <select name="class" id="" class="form-control form_data">
                            <option value="<?php if(isset($class)){
                        echo $class;
                      }else{
                        echo "";
                      } ?>"><?php if(isset($class)){
                        echo $class;
                      }else{
                        echo "Select Student Class";
                      } ?></option>
                      <?php
                      $sql = "SELECT class FROM class";
                      $stmt = $conn->prepare($sql);
                      $stmt->execute();
                      $result = $stmt->get_result();
                      if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                          echo '
                          <option value='.$row['class'].'>'.$row['class'].'</option>
                          ';
                        }
                      }
                      ?>
                        </select>
                    </div>
                    </div>

                    <div class="form-floating">
                    <input class="form-control" name="time" placeholder="Address" type="text" id="floatingTextarea" />
                    <label for="floatingTextarea">Enter time - hour / minute / second</label>
                  </div>
                
                <div class="text-center">
                  <button type="submit" name="cbt-btn" class="btn btn-success form-control">Continue</button>
                </div>
              </form><!-- End floating Labels Form -->

            </div>
          </div>

<?php
/*
for($i=0; $i<=10; $i++){

  echo '
  <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Question One</h5>

              <!-- Floating Labels Form -->
              <form class="row g-3">

                <div class="col-12">
                  <div class="form-floating">
                    <textarea class="form-control" placeholder="Address" id="floatingTextarea" style="height: 100px;"></textarea>
                    <label for="floatingTextarea">Enter Question Here</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="email" class="form-control" id="floatingEmail" placeholder="Your Email">
                    <label for="floatingEmail">Option one</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Option Two</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="email" class="form-control" id="floatingEmail" placeholder="Your Email">
                    <label for="floatingEmail">Option Three</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Option Four</label>
                  </div>
        
                </div>
                <div class="form-floating">
                    <input class="form-control" placeholder="Address" type="text" id="floatingTextarea" />
                    <label for="floatingTextarea">Enter Answer Here</label>
                  </div>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-success form-control">Continue</button>
                </div>
              </form><!-- End floating Labels Form -->

            </div>
          </div>

  ';
} */
?>

</div>
</div>
</section>


<?php require "main-footer.php"; ?>