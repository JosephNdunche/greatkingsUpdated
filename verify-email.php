<?php
require_once "main-header.php";
$error = [];
$email = $row['email'];

if(isset($_POST['verify-email'])){
  $verify_email = $_POST['code'];

  if(empty($verify_email)){
    $error['error'] = "This field cannot be empty";
  }

  if(count($error) == 0){
    $staff = $_SESSION['staff'];
    $code = $row['email_verify'];
    $sql = "SELECT * FROM staff WHERE unique_id=? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $staff);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
      $fetch = $result->fetch_assoc();
  
      if($fetch['email_verify'] === $verify_email){
        $sql1 = "UPDATE staff SET v_email='1' WHERE unique_id='$staff'";
        $stmt1 = $conn->prepare($sql1);
        if($stmt1->execute()){
        echo "<script>location.href = 'staff-email-verified.php';</script>";
      }} else{
        $error['error'] = "The code does not match";
      }
    } else{
      $error['error'] = "No user like that";
    }
  }
}

?>

<main>

    <div class="container">
    <section class="section pt-5 mt-5">
      <div class="row d-flex flex-column align-items-center justify-content-center">
        <div class="col-lg-6">
        <div class="text-center">
        <i class="bi bi-envelope" style="font-size: 3rem; color: green;"></i>
        </div>
              <h2 class="card-title text-center pb-3" style="font-size: 1.5rem;">Verify Email</h2>
              <p class="text-center"><span style="color: green;"><?php  if(isset($_SESSION['staff_lastname'])){
                echo $_SESSION['staff_lastname'];
              } else{
                echo "Hello";
              } ?></span>,  We just sent your authentication code via email to <?= substr($email, 0, 1); ?>*******@gmail.com.</p>
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
              <label for="code" class="mb-2 mt-2">Device Verification Code</label>
              <input type="text" name="code" id="" class="form-control" placeholder="Enter 8 digit Code">
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

  <?php require "main-footer.php"; ?>