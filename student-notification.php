<?php require "student-header.php"; ?>

<div class="container mt-5 pt-4">

<nav>
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php"><i class="bi bi-house-door"></i></a></li>
      <li class="breadcrumb-item"><a href="#">Your Notification <i class="bi bi-bag-check" style="font-size: 1.2rem; color: green;"></i></a></li>
              </ol>
</nav>

</div>

<section class="section mt-2">
      <div class="row justify-content-center">
        <div class="col-lg-6">

          
            <?php 
            $staff_id = $_SESSION['student'];
            $sql = "SELECT * FROM notification WHERE unset = '1' AND (unique_id=? OR unique_id='student') ORDER BY notification_id DESC";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $staff_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0){
              while($fetch = $result->fetch_assoc()){
                echo '
                <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Great Kings Academy</h5>
                  <p>'.$fetch['message'].'</p>
                  <p class="text-success">'.$fetch['time'].'</p>
    
                </div>
              </div>
    
                ';
              }
            }
            ?>

          </div>
          </div>
          </section>



<?php require "main-footer.php"; ?>
