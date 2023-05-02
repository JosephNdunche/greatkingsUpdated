
<?php
require "admin-header.php"; 

?>

<div class="container mt-5 pt-4">

  <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="admin-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">School Feed</a></li>
                </ol>
  </nav>

</div>

  <main id="main" class="main mt-0 pt-0">
    

            <div class="row mb-3">
              <div class="col-md-6 d-flex justify-content-center align-items-center">
              <img style="width: 50px;" src="uploads/<?php echo $row['image']; ?>" alt="Profile" class="rounded-circle">
                <a href="post.php"><input type="text" class="form-control fw-400 ms-3 border-0" style="border-radius: 20px; width: calc(100% - 20px);" placeholder="What's on your mind?"></a>
              </div>
            </div>

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

          <?php
          $admin_id = $_SESSION['admin'];

            $sql = "SELECT * FROM post ORDER BY post_id DESC";
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
                  $sql4 = "SELECT * FROM likes WHERE post_id='$comment_id' AND unique_id='$admin_id'";
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
            <a href="admin-likes.php?comment_id=<?= $fetch['post_id']; ?>"><i class="<?= $click_likes; ?> social-btn post-bar-toggle"></i><span class="badge bg-white text-success"><?= $count_likes; ?></span></a>
            <a href="admin-comment.php?comment_id=<?= $fetch['post_id']; ?>"><i class="bi bi-chat-text social-btn post-bar-toggle"></i><span class="badge bg-white text-success"><?= $count_comment; ?></span></a>
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
        }
      
      
         ?>
        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <?php require "main-footer.php"; ?>