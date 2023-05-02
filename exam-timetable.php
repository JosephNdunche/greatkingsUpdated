<?php require "admin-header.php"; ?>


<main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Timetable Editor</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-6">

          <div class="card text-center">
            <div class="card-body">
            <div class="text-center py-3">
              <i class="bi bi-exclamation-circle text-danger" style="font-size: 2.5rem;"></i>
              </div>
              <p>You can only edit the Exam Time Table of Great Kings Academy
            </p>

              <!-- TinyMCE Editor -->
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
              <textarea class="tinymce-editor" name="timetable">
            
            </textarea>
            <div class="text-danger">
                      <?php
                        if(isset($error['timetable'])){
                          echo $error['timetable'];
                        }
                        ?>
                      </div>

                        <select name="user" id="user" class="form-control mt-3">
                            <option value="">Select User</option>
                            <option value="senior">Senior Students</option>
                            <option value="junior">Junior Students</option>
                        </select>
                      <button class="btn text-white form-control my-3" name="exam-timetable-btn" style="background-color: green;">Upload TimeTable</button>
            
              </form>

            </div>
          </div>


        </div>
      </div>
    </section>

  </main><!-- End #main -->

<?php require "main-footer.php"; ?>