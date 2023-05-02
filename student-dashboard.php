
<?php
require "student-header.php"; 
?>
<style>
  .active{
    display: none;
  }
</style>
<div class="container mt-5 pt-4">
<?php
$staff_id = $_SESSION['student'];
$birthday_sql = 'SELECT * FROM users WHERE student_id=?';
$birthday_stmt = $conn->prepare($birthday_sql);
$birthday_stmt->bind_param('s', $staff_id);
$birthday_stmt->execute();
$get_birthday_stmt_data = $birthday_stmt->get_result();
if($get_birthday_stmt_data->num_rows > 0){
  $birthday_row = $get_birthday_stmt_data->fetch_assoc();
}

date_default_timezone_set("Asia/Calcutta");
$now = Date('Y-m-d');
$birth = substr($now, 5);

$student_birthday = substr($birthday_row['date_of_birth'], 5);

if($student_birthday === $birth){
  echo "<script>alert('Happy Birthday');</script>";
}



?>


  <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="student-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">School Feed</a></li>
                </ol>
  </nav>

</div>

  <main id="main" class="main mt-0 pt-0">

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

          <?php
          $sql = "SELECT * FROM users WHERE student_id=? AND admin_verify='1'";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('s', $staff_id);
          $stmt->execute();
          $result = $stmt->get_result();
          if($result->num_rows > 0){

            $sql = "SELECT * FROM post WHERE user='parent' OR user='both' ORDER BY post_id DESC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0){
              while($fetch = $result->fetch_assoc()){
                $admin = $fetch['admin_id'];
                $comment_id = $fetch['post_id'];
                $sql = "SELECT * FROM staff WHERE unique_id='$admin'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
               $result_row = $stmt->get_result();
               if($result_row->num_rows > 0){
                  $fetch_row = $result_row->fetch_assoc();
                  $sql = "SELECT * FROM comment WHERE post_id='$comment_id'";
                  $stmt = $conn->prepare($sql);
                  $stmt->execute();
                  $get_result = $stmt->get_result();
                  $count_comment = $get_result->num_rows;
                  $sql = "SELECT * FROM likes WHERE post_id='$comment_id'";
                  $stmt = $conn->prepare($sql);
                  $stmt->execute();
                  $likes_result = $stmt->get_result();
                  $count_likes = $likes_result->num_rows;
                  $sql4 = "SELECT * FROM likes WHERE post_id='$comment_id' AND unique_id='$staff_id'";
                  $stmt4 = $conn->prepare($sql4);
                  $stmt4->execute();
                  $likes_result4 = $stmt4->get_result();
                  if($likes_result4->num_rows > 0){
                    $click_likes = "bi bi-heart-fill";
                  } else {
                    $click_likes = "bi bi-heart";
                  }
              ?>

      <div class="col-xxl-4 col-md-6">
      <div class="card info-card sales-card">

        <div class="filter">
          <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

            <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i>Profile</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-send"></i>Message</a></li>
            <li><a class="dropdown-item" href="#"><i class="bi bi-telephone-outbound"></i>Call</a></li>
          </ul>
        </div>

        <div class="card-body">
          <h5 class="card-title"><a class="nav-link nav-profile d-flex align-items-center pt-0" href="#" data-bs-toggle="dropdown">
            <img style="height: 40px; width: 40px;" src="uploads/<?= $fetch_row['image']; ?>" alt="Profile" class="rounded-circle">
            <span class="d-md-block ps-2"><?= $fetch_row['lastname'].' '. $fetch_row['firstname']; ?></span>
          </a><!-- End Profile Iamge Icon --></h5>

          <div class="row g-0">
            <div class="col-lg-12">
              <img  src="uploads/<?= $fetch['image']; ?>" class="img-fluid rounded-start img-responsive" style="width: 100%;" alt="...">
            </div>
            <p class="card-text pt-3"><?= $fetch['text']; ?></p>
            <hr>
         
          <div class="row">
            <div class="col-sm-12 d-flex align-items-center justify-content-between">
            <a href="likes.php?comment_id=<?= $fetch['post_id']; ?>"><i class="<?= $click_likes; ?> social-btn post-bar-toggle"></i><span class="badge bg-white text-success"><?= $count_likes; ?></span></a>
            <a href="student-comment.php?comment_id=<?= $fetch['post_id']; ?>"><i class="bi bi-chat-text social-btn post-bar-toggle"></i><span class="badge bg-white text-success"><?= $count_comment; ?></span></a>
            <div><i class="bi bi-share social-btn"></i><span class="badge bg-white text-success"></span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
      <?php

    } }} else {
          echo "<div class='text-center mt-5 text-danger'>no post</div>";
        }}
          else{
          ?>

            <!-- Sales Card -->
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
                    <p class="card-text pt-3">Hi <span style="color: green;"><?php echo $row['lastname']; ?></span>, Great Kings Academy welcomes you to this platform, it is no news that the world is going digital and we have also decided to join the trend and we employ every Parent to join us with this new development. <br />
                  <span class="text-danger">You can't access anything here until the admin verifies your account. We will send you an email immediately after your account has been verified. <br />
                  for the admin to know you are the one, click on the profile page and update your profile.
                </span>
                  </p>
                  <a href="student-profile.php" class="btn btn-success">Update Profile</a>
                 
                </div>
              </div>
            </div>
          </div><!-- End Card with an image on left -->

         <?php
        
        }?>

         
        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <?php
if(isset($_POST['like-btn'])){

  $sql = "INSERT INTO likes(post_id, date) VALUES(?,NOW())";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $comment_id);
  $stmt->execute();
}

?>

  <?php require "main-footer.php"; ?>