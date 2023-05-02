<?php require "main-header.php"; ?>


<?php
          $staff_id = $_SESSION['staff'];
          $class = $_SESSION['class'];
          $sql = "SELECT * FROM staff WHERE unique_id=? AND admin_verify='1' AND class=?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('ss', $staff_id, $class);
          $stmt->execute();
          $result = $stmt->get_result();
          if($result->num_rows > 0){

            ?>
            
            <div class="container mt-5 pt-5">

<nav>
  <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="dashboard.php"><i class="bi bi-house-door"></i></a></li>
      <li class="breadcrumb-item"><a href="#">Manage Students <i class="bi bi-people" style="font-size: 1.2rem; color: green;"></i></a></li>
              </ol>
</nav>

</div>
            
<div class="card text-center">
            <div class="card-body pt-3">
            <div class="text-center">
              <i class="bi bi-exclamation-circle text-danger" style="font-size: 2.5rem;"></i>
              </div>
              <p>You can only manage <?php echo $row['class']; ?> class because you are their class teacher.</p>

              </div><!-- End Card with an image on left -->
            </div>
              
                <?php 
                $error = [];
                $class = $row['class'];
            $sql = "SELECT * FROM users WHERE admin_verify='0' AND class='$class'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0){
              echo '
                <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">image</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                ';
              while($fetch = $result->fetch_assoc()){
                echo '
                <tr>
                    <td><img style="height: 70px; width: 70px;" src="uploads/'.$fetch['image'].'" class="img-fluid" /></td>
                    <td>'.$fetch['astname'].'</td>
                    <td>'.$fetch['firstname'].'</td>
                    <td><a href="manage-student-profile.php?student_id='.$fetch['student_id'].'"><i class="bi bi-box-arrow-up fs-5" style="color: green;"></i></a></td>
                  </tr>
                ';
              }
            ?>
           
                  
                </tbody>
              </table>
              <!-- End Bordered Table -->
              <?php 
             } else{
                $error['error'] = "<div class='text-center py-1 text-danger fs-5 fw-bold'>
                <i class='bi bi-emoji-frown text-danger' style='font-size: 2.5rem;'></i><br />No New Student Found</div>";
              }

?>
<?php
            } else{
              ?>

 <!-- Sales Card -->
 <div class="col-xxl-4 col-md-6 mt-5">
              <div class="card info-card sales-card">

                <div class="card-body">

                  <div class="row g-0">
                    <div class="col-lg-4">
                      <img  src="./assets/img/florieren/logout2.png" class="img-fluid rounded-start img-responsive" style="width: 100%;" alt="...">
                    </div>
                    <p class="card-text pt-3">Hi, <span style="color: green;"><?php echo $row['lastname']; ?></span>, Great Kings Academy welcomes you to this platform, it is no news that the world is going digital and we have also decided to also go digital and we employ every staff to join us with this new development. <br />
                  <span class="text-danger">News and updates will be passed acrossed through this medium after the admin has verified your account</span>. 
                  </p>
                 
                </div>
              </div>
            </div>
      
              <?php
            }
?>
<div class="text-danger text-center mb-3">
  <?php
                        if(isset($error['error'])){
                          echo $error['error'];
                        }
                        ?>
  </div>

<?php require "main-footer.php"; ?>
