<?php require "admin-header.php"; ?>

<div class="container mt-5 pt-5">
  
  <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="admin-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Manage Assignment <i class="bi bi-people" style="font-size: 1.2rem; color: green;"></i></a></li>
                </ol>
  </nav>


</div>

<div class="card">
  <div class="card-body pt-3">
      <div class="text-center pb-2">
              <i class="bi bi-exclamation-circle text-danger" style="font-size: 2.5rem;"></i>
              </div>
              <p>As the Admin of Great Kings Academy, you can manage the Assignment by verifying the assignments uploaded by the teachers.</p>
      
      <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
          <select name="class" class="form-control form_data">
              <option value="">Select Class</option>
              <?php
              $sql = "SELECT class FROM class";
              $stmt = $conn->prepare($sql);
              $stmt->execute();
              $result = $stmt->get_result();
              if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                   echo '
                   <option value='.$row['class'].'>'.$row['class'].'</option>
                   ';
                }
              }
                    ?>
                     </select>
                 </div>

                     <div class="container">

                     <button type="submit" class="btn btn-success form-control mb-3" name="admin-manage-assignment">Manage Assignment</button>
                     </div>
              </form>
                    </div>
                    </div>
            </div>

           <?php 
            $error = [];
            if (isset($_POST['admin-manage-assignment'])) {

              $class = $_POST['class'];

              if(count($error) === 0){
                $sql = "SELECT * FROM assignment WHERE class='$class' ORDER BY assignment_id DESC";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                if($result->num_rows > 0){
                  echo '
                <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Staff image</th>
                    <th scope="col">Class</th>
                    <th scope="col">Staff Name</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                ';
                  while($fetch = $result->fetch_assoc()){
                    $teacher_id = $fetch['staff_id'];
                    $sql = "SELECT * FROM staff WHERE unique_id='$teacher_id'";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $get_result = $stmt->get_result();
                    if($get_result->num_rows > 0){
                      $fetch_staff = $get_result->fetch_assoc();
                      echo '
                      <tr>
                          <td><img style="height: 70px; width: 70px;" src="uploads/'.$fetch_staff['image'].'" class="img-fluid" /></td>
                          <td>'.$fetch_staff['class'].'</td>
                          <td>'.$fetch_staff['lastname'].' '. $fetch_staff['firstname'].'</td>
                          <td><a href="admin-view-assignment.php?assignment_id='.$fetch['assignment_id'].'"><i class="bi bi-box-arrow-up fs-5" style="color: green;"></i></a></td>
                        </tr>
                      ';
                    }
                    
                  }    
                  echo '
                    </tbody>
                    </table>
                    ';
                    
                  }
                  else{
                    echo "<div class='text-center py-1 text-danger fs-5 fw-bold'>
                    <i class='bi bi-emoji-angry text-danger' style='font-size: 2.5rem;'></i><br />
                    No Assignment found</div>";
                  }
              
                }
                
            }
        
          
            
        ?>      

            
                           

<?php require "main-footer.php"; ?>



           