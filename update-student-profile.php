<?php
require_once "student-header.php"; 
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
                  <button class="nav-link text-success" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

              </ul>
              <div class="tab-content pt-2">


                <div class="tab-pane show active fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="uploads/<?php echo $row['image']; ?>" alt="Profile">
                        <div class="pt-2">
                          <a href="update-student-picture.php" class="btn btn-success btn-sm" title="Upload new profile image"><i class="bi bi-upload text-white"></i></a>
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
                        <input name="address" type="text" class="form-control" id="Address" value="<?php if(isset($row['home_address']) ){
                          echo $row['home_address'];
                        } else{
                          echo "Enter Home Address";
                        } ?>">
                      </div>
                      <?php
                        if(isset($error['address'])){
                          echo "<div>error</div>";
                        }
                        ?>
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
                      <button type="submit" name="update-profile" class="btn btn-success">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>
                

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php require "main-footer.php"; ?>