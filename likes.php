<?php require "student-header.php"; ?>

<style>
    .bottom{
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: #fff;
    }
</style>

<?php
if(isset($_GET['comment_id'])){
    $comment_id = $_GET['comment_id'];
 }

  if(isset($_POST['like_btn'])){
    $comment_id = $_POST['comment_id'];
    $unique_id = $row['student_id'];

    $sql = "INSERT INTO likes(post_id, unique_id, date) VALUES(?,?,NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $comment_id, $unique_id);
    if($stmt->execute()){
        echo "<script>location.href = 'student-dashboard.php';</script>";
    }
  }

?>

<div class="container mt-5 pt-4">

<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="student-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Like Post</a></li>
                </ol>
  </nav>
</div>

<div class="container-fluid"> 

 <section class="section dashboard mt-4 ">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12 align-items-center">
          <div class="row ">
            <?php

          $sql = "SELECT * FROM post WHERE post_id='$comment_id'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0){
              $fetch = $result->fetch_assoc();
                $admin = $fetch['admin_id'];
                $sql = "SELECT * FROM staff WHERE unique_id='$admin'";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
               $result_row = $stmt->get_result();
               if($result_row->num_rows > 0){
              $fetch_row = $result_row->fetch_assoc();
               }
            }
              ?>

             
        
      <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
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
                    <input type="hidden" name="comment_id" value="<?= $comment_id; ?>">
            <button class="btn btn-success ms-2" name="like_btn">Like Post <i class="bi bi-send text-white"></i></button>
                  
                </div>
              </div>
            </div>
          </div>
          </form>
     
  
        </div><!-- End Right side columns -->

      </div>
    </section>

</div>



<?php require "comment-footer.php"; ?>