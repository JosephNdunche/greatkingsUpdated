
<?php
require "admin-header.php";
?>

<?php

if(isset($_GET['student_id'])){
    $student_id = $_GET['student_id'];
}

$sql = "SELECT * FROM users WHERE student_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $student_id);
$stmt->execute();
$get_result = $stmt->get_result();
if($get_result->num_rows > 0){
  $fetch_data = $get_result->fetch_assoc();
}
?>

<div class="container mt-5 pt-4 text-center">

<div class="row justify-content-center">
    <div class="col-lg-4">
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Manage Result <i class="bi bi-receipt-cutoff" style="font-size: 1.2rem;"></i></a></li>
                </ol>
  </nav>

<section class="signup py-4">
<div>
<div class="card text-center">
            <div class="card-body">
            <div class="text-center py-2">
              <i class="bi bi-exclamation-circle text-danger" style="font-size: 2.5rem;"></i>
              </div>
              <p class="py-2">To Manage <span class="text-success fw-bold"><?= $fetch_data['lastname']; ?></span> result you have to select the term and session you wish to check</p>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

<div class="row mb-3">
                  <div class="col-sm-12">
                  <select name="term" id="" class="form-select" aria-label="Default select example">
                            <option value="">select term</option>
                      <?php
                      $sql_term = "SELECT term FROM term";
                      $term_stmt = $conn->prepare($sql_term);
                      $term_stmt->execute();
                      $term_result = $term_stmt->get_result();
                      if($term_result->num_rows > 0){
                        while($term_row = $term_result->fetch_assoc()){
                          echo '
                          <option value='.$term_row['term'].'>'.$term_row['term'].'</option>
                          ';
                        }
                      }
                      ?>
                        </select>
                        <div class="text-danger mt-2">
                        <?php
                        if(isset($error['term'])){
                          echo $error['term'];
                        }
                        ?>
                        </div>
                        </div>
                      </div> 
                      <div class="row mb-3">
                  <div class="col-sm-12">
                  <select name="session" id="session" class="form-select" aria-label="Default select example">
                            <option value="">Select session</option>
                      <?php
                      $sql_session = "SELECT session FROM session";
                      $session_stmt = $conn->prepare($sql_session);
                      $session_stmt->execute();
                      $session_result = $session_stmt->get_result();
                      if($session_result->num_rows > 0){
                        while($session_row = $session_result->fetch_assoc()){
                          echo '
                          <option value='.$session_row['session'].'>'.$session_row['session'].'</option>
                          ';
                        }
                      }
                      ?>
                        </select>
                        <div class="text-danger mt-2">
                        <?php
                    if(isset($error['section'])){
                      echo $error['section'];
                    }
                    ?>
                        </div>
                  </div>
                </div>
    <div class="text-danger">
  <?php
if(isset($error['result'])){
  echo $error['result'];
}
  ?>
</div>
  </div>

  <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
  
  <button type="submit" class="btn btn-primary form-control bg-success" name="result-btn">Check Result</button>
</form>
</div>
</div>

</div>
</div>
</div>

</section>

<?php require "main-footer.php"; ?>