<?php
require "admin-header.php";

$error = array();

if(isset($_GET['unique_id'])){
    $student_id = $_GET['unique_id'];
}

    $sql = "SELECT * FROM users WHERE student_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt -> bind_param('s', $student_id);
        if($stmt->execute()){
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
        } else{
            "error";
        }
    

        $sql = "SELECT * FROM scratch_card WHERE student_id = ? AND verified='0'";
        $stmt = $conn->prepare($sql);
        $stmt -> bind_param('s', $student_id);
        if($stmt->execute()){
            $result = $stmt->get_result();
            $rows = $result->fetch_assoc();
        } else{
            "error";
        }
    ?>
   
<section class="signup pt-5 mt-4">
<div class="container">  
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="student-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Manage School Fees <i class="bi bi-receipt-cutoff" style="font-size: 1.2rem;"></i></a></li>
                </ol>
  </nav>

<main id="main" class="main pt-0 mt-5">

    <div class="pagetitle">
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

         <!-- Card with an image on top -->
         <div class="card">
            <img src="uploads/<?php echo $rows['upload'];  ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['lastname'];  ?> <?php echo $row['firstname'];  ?></span></h5>
              <p class="card-text">This Student just paid a token of <span class="text-success"><?= $rows['transfer_amount']; ?> Naira for school fees in <span class="text-success"><?= $row['class']; ?></span></span> class. <br />
            <span class="text-danger">if you are satisfied with the above payment and requirements, click the button below to verify payment.</span>
            </p>
              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
              <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
              <button type="submit" class="btn btn-success" name="payment">Approve Payment</button>
            </div>
              </form>
            </div>
          </div><!-- End Card with an image on top -->

               
</section>

<?php require_once "main-footer.php";  ?>