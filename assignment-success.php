
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
    
              <p class="text-center">Dear <span style="color: green;"><?php echo $row['lastname']; ?>,</span> You have successfully uploaded <span style="color: green;"><?php echo $_SESSION['assignment-subject'] . "</span> assignment to <span >" . $_SESSION['assignment-class'] ; ?></span> Class.
              </p>
              <?php
              $student_id = 'student';
              $message = $_SESSION['staff_lastname'] . ' ' . $_SESSION['staff_firstname'] . " just uploaded " . $_SESSION['assignment-subject'] . " assignment to " . $_SESSION['assignment-class'] . ' Class';
              $notification_sql = "INSERT INTO notification (unique_id, message, time) VALUES(?,?,NOW())";
              $notification_stmt = $conn->prepare($notification_sql);
              $notification_stmt->bind_param('ss', $student_id, $message);
              $notification_stmt->execute();
              ?>
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
              <a href="dashboard.php" class="btn w-100 mt-2" style="background-color: green; color: #fff;">Continue</a>
            </form>

        </div>

      </div>
    </section>
    </div>

  </main><!-- End #main -->

  <?php require "main-footer.php"; ?>
