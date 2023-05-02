<?php
require_once "student-header.php"; 
require "backend/update-student-profile.php"; 
?>


  <main id="main" class="main">

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="uploads/<?php echo $row['image']; ?>" alt="Profile" class="rounded-circle">
              <h2><?php echo $row['lastname'] .' '. $row['firstname']; ?></h2>
              <p><?php echo $_SESSION['student']; ?></p>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About Your Self</h5>
                  <p class="small fst-italic"><?php if(($row['about']) !== ""){
                      echo $row['about']; 
                    } else {
                      echo '<div class="text-danger">Update Your Profile</div>';
                    }?></p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['lastname'] .' '. $row['firstname']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php if($row['v_email'] === '0'){
                      echo $row['email']; ?> <a class="btn btn-danger" href="verify-student-email.php">Verify Email Address</a>
                     <?php } else {
                      echo $row['email']; 
                      }
                      ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Telephone</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['telephone']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Class</div>
                    <div class="col-lg-9 col-md-8"><?php echo $row['class']; ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Home Address</div>
                    <div class="col-lg-9 col-md-8"><?php if(($row['home_address']) !== "" ){
                      echo $row['home_address']; 
                    } else {
                      echo '<div class="text-danger">Update Your Profile</div>';
                    }?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">State of Origin</div>
                    <div class="col-lg-9 col-md-8"><?php if(($row['state_of_origin']) !== ""){
                      echo $row['state_of_origin']; 
                    } else {
                      echo '<div class="text-danger">Update Your Profile</div>';
                    }?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Date of Birth</div>
                    <div class="col-lg-9 col-md-8"><?php if(($row['date_of_birth']) !== ""){
                      echo $row['date_of_birth']; 
                    } else {
                      echo '<div class="text-danger">Update Your Profile</div>';
                    }?></div>
                  </div>


                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Father's Names</div>
                    <div class="col-lg-9 col-md-8"><?php if(($row['father_name']) !== ""){
                      echo $row['father_name']; 
                    } else {
                      echo '<div class="text-danger">Update Your Profile</div>';
                    }?></div>        
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Mother's Names</div>
                    <div class="col-lg-9 col-md-8"><?php if(($row['mother_name']) !== ""){
                      echo $row['mother_name']; 
                    } else {
                      echo '<div class="text-danger">Update Your Profile</div>';
                    }?></div>                 
                </div>

                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Year of Admission</div>
                    <div class="col-lg-9 col-md-8"><?php if(($row['year_of_admission']) !== ""){
                      echo $row['year_of_admission']; 
                    } else {
                      echo '<div class="text-danger">Update Your Profile</div>';
                    }?></div>               
                </div>

                <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Parent Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="uploads/<?php echo $row['parent_image']; ?>" style="width: 7rem; height: 5rem;" alt="Profile">
                        <div class="pt-2">
                          <a href="update-parent-picture.php" class="btn btn-success btn-sm" title="Upload new profile image"><i class="bi bi-upload text-white"></i></a>
                        </div>
                      </div>
                    </div>

                  </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POSt" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                  <div class="text-center">
                        <?php
                        if(isset($error['student'])){
                          echo $error['student'];
                        }
                        ?>
                        </div>
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="uploads/<?php echo $row['image']; ?>" alt="Profile">
                        <div class="pt-2">
                          <a href="update-student-picture.php" class="btn btn-success btn-sm" title="Upload new profile image"><i class="bi bi-upload text-white"></i></a>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="firstname" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="firstname" type="text" class="form-control" id="firstname" value="<?php if(isset($row['firstname'])){
                          echo $row['firstname'];
                        } else{
                          echo "Enter First Name";
                        } ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="lastname" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="lastname" type="text" class="form-control" id="lastname" value="<?php if(isset($row['lastname'])){
                          echo $row['lastname'];
                        } else{
                          echo "Enter Last Name";
                        } ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">Tell us about your self</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control" id="about" style="height: 100px"><?php if(isset($row['about'])){
                          echo $row['about'];
                        } else{
                          echo "Tell us about your self";
                        } ?></textarea>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="email" class="col-md-4 col-lg-3 col-form-label">email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="text" class="form-control" id="email" value="<?php if(isset($row['email'])){
                          echo $row['email'];
                        } else{
                          echo "Enter Email Address";
                        } ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="telephone" class="col-md-4 col-lg-3 col-form-label">telephone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="telephone" type="text" class="form-control" id="telphone" value="<?php if(isset($row['telephone'])){
                          echo $row['telephone'];
                        } else{
                          echo "Enter Telephone Number";
                        } ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="class" class="col-md-4 col-lg-3 col-form-label">class</label>
                      <div class="col-md-8 col-lg-9">
                      <select name="class" id="class" class="form-control form_data">
                            <option value="<?php if(isset($row['class'])){
                        echo $row['class'];
                      }else{
                        echo "";
                      } ?>"><?php if(isset($class)){
                        echo $class;
                      }else{
                        echo "Select Student Class";
                      } ?></option>
                      <?php
                      $sql = "SELECT class FROM class";
                      $stmt = $conn->prepare($sql);
                      $stmt->execute();
                      $result = $stmt->get_result();
                      if($result->num_rows > 0){
                        while($rows = $result->fetch_assoc()){
                          echo '
                          <option value='.$rows['class'].'>'.$rows['class'].'</option>
                          ';
                        }
                      }
                      ?>
                        </select>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="Address" value="<?php if(isset($row['home_address'])){
                          echo $row['home_address'];
                        } else{
                          echo "Enter Home Address";
                        } ?>">
                        <?php
                        if(isset($error['address'])){
                          echo $error['address'];
                        }
                        ?>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="date_of_birth" class="col-md-4 col-lg-3 col-form-label">Date of Birth</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="date_of_birth" type="date" class="form-control" id="date_of_birth" value="<?php if(isset($row['date_of_birth'])){
                          echo $row['date_of_birth'];
                        } else{
                          echo "Enter Date of Birth";
                        } ?>">
              
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="state_of_origin" class="col-md-4 col-lg-3 col-form-label">State of Origin</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="state_of_origin" type="text" class="form-control" id="state_of_origin" value="<?php if(isset($row['state_of_origin'])){
                          echo $row['state_of_origin'];
                        } else{
                          echo "Enter State of Origin";
                        } ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="father_name" class="col-md-4 col-lg-3 col-form-label">Father's Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="father_name" type="text" class="form-control" id="father_name" value="<?php if(isset($row['father_name'])){
                          echo $row['father_name'];
                        } else{
                          echo "Enter Father's Names";
                        } ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="mother_name" class="col-md-4 col-lg-3 col-form-label">Mother's Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="mother_name" type="text" class="form-control" id="mother_name" value="<?php if(isset($row['mother_name'])){
                          echo $row['mother_name'];
                        } else{
                          echo "Enter Mother's Names";
                        } ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="year_of_admission" class="col-md-4 col-lg-3 col-form-label">Year of Admission</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="year_of_admission" type="text" class="form-control" id="year_of_admission" value="<?php if(isset($row['year_of_admission'])){
                          echo $row['year_of_admission'];
                        } else{
                          echo "Enter Year of Admission";
                        } ?>">
                      </div>
                    </div>


                    <div class="text-center">
                      <button type="submit" name="update-profile" class="btn btn-success px-5 mt-3" style="border-radius: 15px;">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <?php require "backend/change-student-password.php"; ?>
                   <!-- Change Password Form -->
                   <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

<div class="row mb-3">
  <label for="uid" class="col-md-4 col-lg-3 col-form-label">Enter Email Address</label>
  <div class="col-md-8 col-lg-9">
    <input name="uid" type="text" class="form-control" id="uid" value="<?php if(isset($uid)){
        echo $uid;
    } ?>">
    <div class="text-danger">
        <?php
        if(isset($error['uid'])){
            echo $error['uid'];
        }
        ?>
    </div>
  </div>
</div>

<div class="row mb-3">
  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
  <div class="col-md-8 col-lg-9">
    <input name="newpassword" type="password" class="form-control" id="newPassword">
    <div class="text-danger">
        <?php
        if(isset($error['newpassword'])){
            echo $error['newpassword'];
        }
        ?>
    </div>
  </div>
</div>

<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
  <div class="col-md-8 col-lg-9">
    <input name="renewpassword" type="password" class="form-control" id="renewPassword">
    <div class="text-danger">
        <?php
        if(isset($error['renewpassword'])){
            echo $error['renewpassword'];
        }
        ?>
    </div>
  </div>
</div>

<div class="text-center">
  <button type="submit" class="btn btn-success px-5 mt-3" style="border-radius: 15px;" name="csp-btn">Change Password</button>
</div>
</form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php require "main-footer.php"; ?>