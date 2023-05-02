<?php
session_start();

if(!isset($_SESSION['csp'])){
  header("location: staff-login.php");
}

require_once "database/connection.php";
$error = [];
$email = $_SESSION['email'];

if(isset($_POST['verify-email'])){
  $verify_email = $_POST['code'];
  $_SESSION['code'] = $verify_email;

  if(empty($verify_email)){
    $error['error'] = "This field cannot be empty";
  }

  if(count($error) == 0){
$sql = "SELECT * FROM staff WHERE email_verify=? LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $verify_email);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0){
  $fetch = $result->fetch_assoc();
  
  if($fetch['email_verify'] === $verify_email){
    
    header("location: change-st-password.php");
  }else{
    $error['error'] = "The code does not match";
  }
} else{
  $error['error'] = "The code does not match";
}
}
}

?>
<?php require "includes/header.php"; ?>

<main>

    <div class="container">
    <section class="section pt-5">
      <div class="row d-flex flex-column align-items-center justify-content-center">
        <div class="col-lg-6">
        <div class="text-center">
        <i class="bi bi-lock" style="font-size: 3rem; color: green;"></i>
        </div>
              <h2 class="card-title text-center pb-3" style="font-size: 1.5rem;">Change Password</h2>
              <p class="text-center"><span style="color: green;"><?php  if(isset($fetch['lastname'])){
                echo $fetch['lastname'];
              } else{
                echo "Hi";
              } ?></span>, We just sent your authentication code via email to <span class="text-success fw-bold"><?= $email; ?></span></p>
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
              <label for="code" class="mb-2">Device Verification Code</label>
              <input type="text" name="code" id="code" class="form-control" placeholder="Enter 8 digit Code">
              <div class="text-danger py-2">
                <?php
                if(isset($error['error'])){
                  echo $error['error'];
                }
                ?>
              </div>
              <button type="submit" class="btn w-100 mt-2" name="verify-email" style="background-color: green; color: #fff;">Verify Email</button>
            </form>

        </div>

      </div>
    </section>
    </div>

  </main><!-- End #main -->

  <?php require "includes/footer.php"; ?>