<?php 
session_start();

require "database/connection.php";
require "backend/staff-forgot-password.php";
require "includes/header.php"; 
?>
<style>
  i{
    color: green;
  }
</style>

  <main>
    <div class="container pt-5">

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
                    <h5 class="card-title text-center mt-4 pb-0 fs-4 jquery" style="color: green;">Forgotten Password</h5>
                    <p class="text-center small">Request a Password Reset</p>
                  </div>

                  <form class="row g-3" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

                    <div class="col-12 pt-4">
                      <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-app-indicator"></i></span>
                        <input type="text" name="email" class="form-control form_data" id="email" placeholder="Enter Student Unique Id" value="<?php if(isset($email)){
                        echo $email;
                      } ?>">
                      </div>
                      <div class="text-danger">
                      <?php
                        if(isset($error['email'])){
                          echo $error['email'];
                        }
                        ?>
                      </div>
                    </div>


                    <div class="col-12">
                      <button class="btn w-100 submit_btn" style="background-color: green; color: #fff;" name="sfp-btn" type="submit">Continue</button>
                    </div>
                    <div class="col-12">
                      <p class="small">Already have an account? <a href="student-login.php">Log in</a></p>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>

      </section>

    </div>
  </main><!-- End #main -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php require "includes/footer.php"; ?>