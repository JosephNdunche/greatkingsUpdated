<?php require "main-header.php"; ?>

<section class="signup py-5 mb-5">

<div class="row justify-content-center">
  <div class="col-lg-4">

<div class="container">
<nav>
  <ol class="breadcrumb mt-4">
      <li class="breadcrumb-item"><a href="dashboard.php"><i class="bi bi-house-door"></i></a></li>
      <li class="breadcrumb-item"><a href="#">Select User <i class="bi bi-people" style="font-size: 1.2rem; color: green;"></i></a></li>
              </ol>
</nav>
</div>

<?php
          $staff_id = $_SESSION['staff'];
          $sql = "SELECT * FROM staff WHERE unique_id=? AND admin_verify='1'";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('s', $staff_id);
          $stmt->execute();
          $result = $stmt->get_result();
          if($result->num_rows > 0){

            ?>

<div class="container mb-5">
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="d-flex">
        <input type="search" name="" id="" style="width: calc(100% - 40px);" placeholder="Search for a user" class="form-control">
        <button class="btn btn-success ms-1" name=""><i class="bi bi-send text-white"></i></button> 
    </form>
  </div>

  <?php
  $my_id = $_SESSION['staff'];
  $sql = "SELECT * FROM staff WHERE unique_id != '$my_id' AND admin_verify='1'";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  if($result->num_rows > 0){
    while($get_row = $result->fetch_assoc()){
      $incoming_id = $get_row['unique_id'];
      $outgoing_id = $row['unique_id'];
      $sql2 = "SELECT * FROM messages WHERE (outgoing_id = '$outgoing_id' AND incoming_id='$incoming_id') OR (outgoing_id='$incoming_id' AND incoming_id='$outgoing_id') ORDER BY msg_id DESC";
      $stmt2 = $conn->prepare($sql2);
      $stmt2->execute();
      $result2 =  $stmt2->get_result();
      if($result2->num_rows > 0){
        $row2 = $result2->fetch_assoc();
          $output = $row2['message'];
        } else {
          $output = "No message available";
        }
        (strlen($output) > 28) ? $msg = substr($output, 0, 28) . '....' : $msg = $output;

        $sql3 = "SELECT * FROM messages WHERE incoming_id='$outgoing_id' AND outgoing_id='$incoming_id' AND alert != '1'";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->execute();
        $result3 = $stmt3->get_result();
        $count3 = $result3->num_rows;
        if($count3 === 0){
          $count3 = "";
        }
 
echo 
'
<a href="chat.php?student_id='.$get_row['unique_id'].'" class="text-black">
<div class="container d-flex align-items-center mb-2">
    <div class="left d-flex justify-content-center align-items-center">
        <img src="uploads/'.$get_row['image'].'" style="width: 50px; height: 50px; border-radius: 50%;" alt="">
        <div class="flex ms-3">
            <h4 class="mb-0">'.$get_row['lastname'].' '.$get_row['firstname'].'</h4>
            <p>'.$msg.'</p>
            <hr>
        </div>
    </div>
    <div>
        <span class="badge bg-success badge-number">'. $count3 .'</span>
    </div>
  </div>
</a>

  ';
}
  }


  $sql = "SELECT * FROM users WHERE admin_verify='1'";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  if($result->num_rows > 0){
    while($get_row = $result->fetch_assoc()){
      $incoming_id = $get_row['student_id'];
      $outgoing_id = $row['unique_id'];
      $sql2 = "SELECT * FROM messages WHERE (outgoing_id = '$outgoing_id' AND incoming_id='$incoming_id') OR (outgoing_id='$incoming_id' AND incoming_id='$outgoing_id') ORDER BY msg_id DESC";
      $stmt2 = $conn->prepare($sql2);
      $stmt2->execute();
      $result2 =  $stmt2->get_result();
      if($result2->num_rows > 0){
        $row2 = $result2->fetch_assoc();
          $output = $row2['message'];
        } else {
          $output = "No message available";
        }
        (strlen($output) > 28) ? $msg = substr($output, 0, 28) . '....' : $msg = $output;

        $sql3 = "SELECT * FROM messages WHERE incoming_id='$outgoing_id' AND outgoing_id='$incoming_id' AND alert != '1'";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->execute();
        $result3 = $stmt3->get_result();
        $count3 = $result3->num_rows;
        if($count3 === 0){
          $count3 = "";
        }
 
echo 
'
<a href="chat.php?student_id='.$get_row['student_id'].'" class="text-black">
<div class="container d-flex align-items-center mb-2">
    <div class="left d-flex justify-content-center align-items-center">
        <img src="uploads/'.$get_row['image'].'" style="width: 50px; height: 50px; border-radius: 50%;" alt="">
        <div class="flex ms-3">
            <h4 class="mb-0">'.$get_row['lastname'].' '.$get_row['firstname'].'</h4>
            <p>'.$msg.'</p>
            <hr>
        </div>
    </div>
    <div>
        <span class="badge bg-success badge-number">'. $count3 .'</span>
    </div>
  </div>
</a>

  ';
}
  }
?>
  
  </div>
</div>
<?php
            } else{
              ?>

 <!-- Sales Card -->
 <div class="row justify-content-center">
 <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">

                <div class="row g-0">
                    <div class="col-lg-4">
                      <!-- Slides with controls -->
              <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                  <img  src="./assets/img/florieren/blog1.jpg" class="img-fluid rounded-start img-responsive mt-3" style="width: 100%;" alt="...">
                  </div>
                  <div class="carousel-item">
                  <img  src="./assets/img/florieren/blog3.jpg" class="img-fluid rounded-start img-responsive mt-3" style="width: 100%;" alt="...">
                  </div>
                  <div class="carousel-item">
                  <img  src="./assets/img/florieren/blog4.jpg" class="img-fluid rounded-start img-responsive mt-3" style="width: 100%;" alt="...">
                  </div>
                  <div class="carousel-item">
                  <img  src="./assets/img/florieren/event4.jpg" class="img-fluid rounded-start img-responsive mt-3" style="width: 100%;" alt="...">
                  </div>
                  <div class="carousel-item">
                  <img  src="./assets/img/florieren/event1.jpg" class="img-fluid rounded-start img-responsive mt-3" style="width: 100%;" alt="...">
                  </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>

              </div><!-- End Slides with controls -->
                    </div>
                    <p class="card-text pt-3">Hi <span style="color: green;"><?php echo $row['lastname']; ?></span>, Florieren Park Lane welcomes you to this platform, it is no news that the world is going digital and we have also decided to join the trend and we employ every Staff to join us with this new development. <br />
                  <span class="text-danger">You can't access anything here until the admin verifies your account. We will send you an email immediately after your account has been verified.</span>. 
                  </p>
                 
                </div>
              </div>
            </div>
          </div><!-- End Card with an image on left -->
              <?php
            }
?>
</div>
</div>
</section>

<?php require "main-footer.php"; ?>