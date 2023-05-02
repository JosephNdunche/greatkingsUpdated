
<?php
require "main-header.php"; 

?>

<div class="container mt-5 pt-5">

  <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Edit Library</a></li>
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
          $staff_id = $_SESSION['staff'];

          $sql = "SELECT * FROM staff WHERE unique_id=? AND admin_verify='1'";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('s', $staff_id);
          $stmt->execute();
          $result = $stmt->get_result();
          if($result->num_rows > 0){
            $get_row = $result->fetch_assoc();

            $sql = "SELECT * FROM library WHERE staff_id='$staff_id' ORDER BY library_id DESC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0){
              while($fetch = $result->fetch_assoc()){
          
      echo '
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
                    <img style="height: 40px; width: 40px;" src="uploads/'.$get_row['image'].'" alt="Profile" class="rounded-circle">
                    <span class="d-md-block ps-2">'.$get_row['lastname'].' '. $get_row['firstname']. '</span>
                  </a><!-- End Profile Iamge Icon --></h5>

                  <div class="row g-0 text-center">
                    <h3 class="card-title fw-bold pt-0"><i class="bi bi-card-heading fs-5"></i> '.$fetch['course'].'</h3>
                    <p class="card-text pt-0">'.$fetch['about'].'</p>
                    <hr>
                 
                  <div class="row">
                    <div class="col-sm-12 d-flex align-items-center justify-content-between">
                      <a href="edit-view-library.php?library_id='.$fetch['library_id'].'" class="btn btn-primary form-control">Edit Book</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      ';

        } } 
        else{
          echo "<div class='text-center py-1 text-danger fs-5 fw-bold'>
          <i class='bi bi-emoji-frown text-danger' style='font-size: 2.5rem;'></i><br />No Book Found</div>";
        }} else{
          ?>

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">

                  <div class="row g-0">
                    <div class="col-lg-4">
                      <img  src="./assets/img/florieren/dashboard.png" class="img-fluid rounded-start img-responsive" style="width: 100%;" alt="...">
                    </div>
                    <p class="card-text pt-3">Hi, <span style="color: green;"><?php echo $row['student_lastname']; ?></span>, Great Kings Academy welcomes you to this platform, it is no news that the world is going digital and we have also decided to also go digital and we employ every staff to join us with this new development. <br />
                  <span class="text-danger">News and updates will be passed acrossed through this medium after the admin has verified your account</span>. 
                  </p>
                 
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

  <?php require "main-footer.php"; ?>