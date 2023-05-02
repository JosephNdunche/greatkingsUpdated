<?php
require "student-header.php";
?>

<div class="container mt-5 pt-5">

  <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="student-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Lesson Note</a></li>
                </ol>
  </nav>

</div>

<main id="main" class="main mt-0">

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-6">

          

            <?php
             if(isset($_GET['library_id'])){
              $library_id = $_GET['library_id'];
             }
             $sql = "SELECT * FROM  lesson_note WHERE lesson_note_id='$library_id'";
             $stmt = $conn->prepare($sql);
             $stmt->execute();
             $result = $stmt->get_result();
             if($result->num_rows > 0){
               $get_data = $result->fetch_assoc();
               $staff_id = $get_data['staff_id'];
               $sql1 = "SELECT * FROM  staff WHERE unique_id='$staff_id'";
               $stmt1 = $conn->prepare($sql1);
             $stmt1->execute();
             $get = $stmt1->get_result();
             if($get->num_rows > 0){
               $data = $get->fetch_assoc();

             }

              
             }
             ?>
            
            <div class="col-md-6">
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
                    <img style="height: 40px; width: 40px;" src="uploads/<?= $data['image']; ?>" alt="Profile" class="rounded-circle">
                    <span class="d-md-block ps-2"><?= $data['lastname'].' '. $data['firstname']; ?></span>
                  </a><!-- End Profile Iamge Icon --></h5>

                  <div class="row g-0 text-center">
                    <h3 class="card-title fw-bold pt-0"><i class="bi bi-card-heading fs-5"></i> <?= $get_data['subject']; ?></h3>
                    <p class="card-text pt-0"><?= $get_data['date']; ?></p>
                    <hr>
                 
                  <div class="row">
                    <div class="col-sm-12 d-flex align-items-center justify-content-between">
                      <a href="view-note.php?path=<?= $get_data['lesson_note']; ?>" class="btn btn-success form-control" style="border-radius: 15px;">Download Note</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>



        </div>
      </div>
    </section>

  </main><!-- End #main -->

<?php
require "main-footer.php";
?>