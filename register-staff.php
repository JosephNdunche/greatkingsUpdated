  <?php 
session_start();

if(isset($_SESSION['staff'])){
  header("location: dashboard.php");
}

require "database/connection.php";
require "backend/register-staff.php";
require "includes/header.php"; 
?>
<style>
  i{
    color: green;
  }
</style>

  <main>
    <div class="container pt-5">
    <div class="row justify-content-center">
            <div class="col-lg-4">

      <section class="section register min-vh-98 d-flex flex-column align-items-center justify-content-center">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              </div> 

              <div>

                  <div>
                  <div class="text-center">
                      <img src="./assets/img/florieren/logo.png" style="width: 60px;" alt="">
                    </div>
                    <h5 class="card-title text-center mt-4 pb-0 fs-4 jquery" style="color: green;">Create an Account</h5>
                    <p class="text-center small">Staff should enter their Personal Details</p>
                  </div>

                  <form class="row g-3" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                  <div class="text-danger">
                      <?php
                        if(isset($error['staff'])){
                          echo $error['staff'];
                        }
                        ?>
                      </div>
                    <div class="col-12">
                      <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                      <input type="text" name="firstname" class="form-control form_data" id="firstname" placeholder="Enter Firstname" value="<?php if(isset($firstname)){
                        echo $firstname;
                      } ?>">
                    </div>
                   
                      </div>
                    <div class="col-12">
                      <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <input type="text" name="lastname" class="form-control form_data" id="last_name" placeholder="Enter Lastname" value="<?php if(isset($lastname)){
                        echo $lastname;
                      } ?>">
                      </div>
                      <div class="text-danger">
                      <?php
                        if(isset($error['lastname'])){
                          echo $error['lastname'];
                        }
                        ?>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-briefcase-fill"></i></span>
                        <input type="email" name="email" class="form-control form_data" id="email" placeholder="Enter Email Address" value="<?php if(isset($email)){
                        echo $email;
                      } ?>">
                      </div>
            
                    </div>

                    <div class="col-12">
                      <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-telephone-outbound-fill"></i></span>
                        <input type="tel" name="telephone" class="form-control form_data" id="telephone" placeholder="Enter Telephone" value="<?php if(isset($telephone)){
                        echo $telephone;
                      } ?>">
                      </div>
                     
                    </div>

                    <div class="col-12">
                      <div class="input-group">
                      <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <select name="class" id="" class="form-control form_data">
                            <option value="<?php if(isset($class)){
                        echo $class;
                      }else{
                        echo "";
                      } ?>"><?php if(isset($class)){
                        echo $class;
                      }else{
                        echo "Class teacher of what class";
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

                    <div class="col-12">
                      <button class="btn w-100 submit_btn" style="background-color: green; color: #fff;" name="submit-btn" type="submit">Continue</button>
                    </div>
                    <div class="col-12">
                      <p class="small">Already have an account? <a href="staff-login.php">Log in</a></p>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>

      </section>
    </div>
    </div>

    </div>
  </main><!-- End #main -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php require "includes/footer.php"; ?>