<?php require "admin-header.php"; ?>

<main>

    <div class="container mb-5">
    <section class="section pt-5 mt-5">
      <div class="row d-flex flex-column align-items-center justify-content-center">
        <div class="col-lg-6">
        <div class="text-center">
        <i class="bi bi-check-circle-fill" style="font-size: 3rem; color: green;"></i>
        </div>
              <h2 class="card-title text-center pb-3">Welcome <span style="color: green; font-size: 1.5rem;"><?php  if(isset($_SESSION['lastname'])){
                echo $_SESSION['lastname'];
              } else{
                echo "Hello";
              } ?></span></h2>
              <p>You are welcome to Great Kings Academy, A school where we provide a conducive learning environment and qualified team of experienced and eloquent seasoned staff for our students .<br /><br />
              Your Student Id is <span style="color: green;"><?php echo $_SESSION['student']; ?></span>, you need your Student Id with your password to login.
              </p>
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
              <a href="admin-dashboard.php" class="btn w-100 mt-2" style="background-color: green; color: #fff;">Continue</a>
            </form>

        </div>

      </div>
    </section>
    </div>

  </main><!-- End #main -->

  <?php require "main-footer.php"; ?>