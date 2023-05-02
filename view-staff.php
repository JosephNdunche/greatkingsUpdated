<?php require "admin-header.php"; ?>

<div class="container mt-5 pt-5">

  <div class="row justify-content-center">
    <div class="col-lg-4">
  
  <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="admin-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">View Staff <i class="bi bi-people" style="font-size: 1.2rem; color: green;"></i></a></li>
                </ol>
  </nav>

            
            <div class="card text-center">
            <div class="card-body pt-3">
              <div class="text-center">
              <i class="bi bi-exclamation-circle text-success" style="font-size: 2.5rem;"></i>
              </div>
              <p>As the Admin you can view all the records of all the staff.</p>
          </div>
          </div>
              
                <?php 
            $sql = "SELECT * FROM staff WHERE admin_verify='1' AND unique_id != '$admin_id'";
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
                    <td>'.$fetch['lastname'].'</td>
                    <td>'.$fetch['firstname'].'</td>
                    <td><a href="view-staff-profile.php?staff_id='.$fetch['unique_id'].'"><i class="bi bi-box-arrow-up fs-5" style="color: green;"></i></a></td>
                  </tr>
                ';
              }
            ?>
           
                  
                </tbody>
              </table>
              <!-- End Bordered Table -->
              <?php 
             } else{
                echo "No user found";
              }

?>
    
    </div>
  </div>
  </div>

 

<?php require "main-footer.php"; ?>
