<?php
session_start();

if(!isset($_SESSION['staff'])){
  header("location: staff-login.php");
}
?>

<?php require "includes/header.php"; ?>

<main>

    <div class="container">
    <section class="section pt-0">
      <div class="row d-flex flex-column align-items-center justify-content-center">
        <div class="col-lg-6">
        <div class="text-center">
        <i class="bi bi-check-circle-fill" style="font-size: 3rem; color: green;"></i>
        </div>
              <h2 class="card-title text-center pb-3" style="font-size: 1.5rem;">Welcome <span style="color: green;"><?php  if(isset($_SESSION['staff_lastname'])){
                echo $_SESSION['staff_lastname'];
              } else{
                echo "Hello";
              } ?></span></h2>
              <p>You are welcome to Great Kings Academy, A school where we provide a conducive learning environment and qualified team of experienced and eloquent seasoned staff for our students .<br /><br />
              Your Unique Id is <span style="color: green;"><?php echo $_SESSION['staff']; ?></span>, you need this with your password to login.
              </p>
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
              <a href="dashboard.php" class="btn w-100 mt-2" style="background-color: green; color: #fff;">Continue</a>
            </form>

        </div>

      </div>
    </section>
    </div>

  </main><!-- End #main -->

  <?php require "includes/footer.php"; ?>