<?php 
session_start();

if(!isset($_SESSION['staff'])){
  header("location: staff-login.php");
}

require "database/connection.php";
require "backend/staff-password.php";
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

                  <div class="pt-0">
                    <h5 class="card-title text-center pb-0 fs-4 jquery" style="color: green;">Create Password</h5>
                    <p class="text-center small mt-3">Password should be atleast 8 characters in length and should include at least one upper case letter, one number and one special character.</p>
                  </div>

                  <form class="row g-3 mt-3" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

                    <div class="col-12">
                      <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                        <input type="password" name="password" class="form-control form_data" id="password" placeholder="Enter Password">
                      </div>
                      <div class="text-danger">
                      <?php
                        if(isset($error['password'])){
                          echo $error['password'];
                        }
                        ?>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                        <input type="password" name="confirm_password" class="form-control form_data" id="confirm_password" placeholder="Confirm Password">
                      </div>
                      <div class="text-danger">
                      <?php
                        if(isset($error['confirm_password'])){
                          echo $error['confirm_password'];
                        }
                        ?>
                      </div>
                    </div>

                    <div class="col-12">
                      <button class="btn w-100 submit_btn" style="background-color: green; color: #fff;" name="password-btn" type="submit">Continue</button>
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