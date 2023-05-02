
<?php 
require "main-header.php"; ?>

<main>

    <div class="container">
    <section class="section pt-5 mt-5">
      <div class="row d-flex flex-column align-items-center justify-content-center">
        <div class="col-lg-6">
        <div class="text-center">
        <i class="bi bi-check-circle-fill" style="font-size: 3rem; color: green;"></i>
        </div>
       <?php
        $student_id = $_SESSION['student_id'];
        $check_query = "SELECT * FROM users WHERE student_id=?";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bind_param('s', $student_id);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();
        if($check_result->num_rows > 0){
            $rows = $check_result->fetch_assoc();
            $student_lastname = $rows['lastname'];
            $student_firstname = $rows['firstname'];
        }

            $admin_id = "admin";
            $message = "Your staff " . $row['lastname'] . ' ' . $row['firstname'] . " has uploaded " . $student_lastname . " " . $student_firstname . " " . $_SESSION['student_course'] . " result in " . $_SESSION['staff_class'] . " class in session " . $_SESSION['student_session'] . " and for " . $_SESSION['student_term'] . " term";
            $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
            $notification_stmt = $conn->prepare($notification_sql);
            $notification_stmt->bind_param('ss', $admin_id, $message);
            $notification_stmt->execute();
          ?>
    
              <p class="text-center">Dear <span style="color: green;"><?= $row['lastname']; ?>,</span> You have successfully uploaded <span style="color: green;"><?= $student_lastname; ?>  <?= $student_firstname; ?></span> <span > <?= $_SESSION['student_course'] ; ?></span> result.
              </p>
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
              <a href="staff-upload-result.php" class="btn w-100 mt-2" style="background-color: green; color: #fff;">Continue</a>
            </form>

        </div>

      </div>
    </section>
    </div>

  </main><!-- End #main -->

  <?php require "main-footer.php"; ?>