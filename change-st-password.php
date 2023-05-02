<?php
session_start();

if(!isset($_SESSION['csp'])){
  header("location: staff-login.php");
}

require_once "header.php"; 
require "backend/change-st-password.php";
?>


  <main id="main" class="main container">

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

                   <!-- Change Password Form -->
                   <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

                   <h3 class="mb-5 text-success">Change Password</h3>

<div class="row mb-3">
  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
  <div class="col-md-8 col-lg-9">
    <input name="newpassword" type="password" class="form-control" id="newPassword">
    <div class="text-danger">
        <?php
        if(isset($error['newpassword'])){
            echo $error['newpassword'];
        }
        ?>
    </div>
  </div>
</div>

<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
  <div class="col-md-8 col-lg-9">
    <input name="renewpassword" type="password" class="form-control" id="renewPassword">
    <div class="text-danger">
        <?php
        if(isset($error['renewpassword'])){
            echo $error['renewpassword'];
        }
        ?>
    </div>
  </div>
</div>

<div class="text-center">
  <button type="submit" class="btn btn-success" name="pass-btn">Change Password</button>
</div>
</form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php require "footer.php"; ?>