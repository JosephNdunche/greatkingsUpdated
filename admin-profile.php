<?php
require_once "admin-header.php"; 
require "backend/change-admin-password.php";
?>


  <main id="main" class="main">

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="uploads/<?php echo $row['image']; ?>" alt="Profile" class="rounded-circle">
              <h2><?php echo $row['lastname'] .' '. $row['firstname']; ?></h2>
              <p><?php echo $_SESSION['admin']; ?></p>
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
                  <h5 class="card-title">About</h5>
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
                    <div class="col-lg-9 col-md-8"><?php echo $row['email']; ?></div>
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

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POSt" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="uploads/<?php echo $row['image']; ?>" alt="Profile">
                        <div class="pt-2">
                          <a href="update-admin-picture.php" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload text-white"></i></a>
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash text-white"></i></a>
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
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control" id="about" style="height: 100px"><?php if(isset($row['about'])){
                          echo $row['about'];
                        } else{
                          echo "Enter About Yourself";
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
                        <input name="class" type="text" class="form-control" id="class" value="<?php if(isset($row['class'])){
                          echo $row['class'];
                        } else{
                          echo "Enter Class";
                        } ?>">
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
                        <div class="text-danger">
                        <?php
                        if(isset($error['date_of_birth'])){
                          echo $error['date_of_birth'];
                        }
                        ?>
                        </div>
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

                    <div class="text-center">
                      <button type="submit" name="update-profile" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>
            
                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                  <div class="text-danger">
        <?php
        if(isset($error['admin'])){
            echo $error['admin'];
        }
        ?>
    </div>

<div class="row mb-3">
  <label for="uid" class="col-md-4 col-lg-3 col-form-label">Enter Email Address</label>
  <div class="col-md-8 col-lg-9">
    <input name="uid" type="text" class="form-control" id="uid" value="<?php if(isset($uid)){
        echo $uid;
    } ?>">

  </div>
</div>

<div class="row mb-3">
  <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
  <div class="col-md-8 col-lg-9">
    <input name="newpassword" type="password" class="form-control" id="newPassword">
   
  </div>
</div>

<div class="row mb-3">
  <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
  <div class="col-md-8 col-lg-9">
    <input name="renewpassword" type="password" class="form-control" id="renewPassword">

  </div>
</div>

<div class="text-center">
  <button type="submit" class="btn btn-success" name="cap-btn">Change Password</button>
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