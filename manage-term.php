<?php require "admin-header.php";
require "backend/manage-term.php";
?>

<div class="container mt-5 pt-5">

  <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="admin-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Manage Term <i class="bi bi-people" style="font-size: 1.2rem; color: green;"></i></a></li>
                </ol>
  </nav>

            
<div class="card text-center">
            <div class="card-body pt-3">
              <div class="text-center">
              <i class="bi bi-exclamation-circle text-danger" style="font-size: 2.5rem;"></i>
              </div>
              <p>Select the current Term.</p>
      
              <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
              <div class="mb-3 mt-3">

                <select name="term" id="term" class="form-control">
                    <?php
                    $sql = "SELECT term FROM term";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if($result->num_rows > 0){
                        echo '<option value="">Select Term</option>';
                        while($get_result = $result->fetch_assoc()){
                        echo '
                        <option value='.$get_result['term'].'>'.$get_result['term'].'</option>
                    ';
                    }
                }
                    ?>
                </select>
    <div class="text-danger pt-3">
    <?php
if(isset($error['term'])){
  echo $error['term'];
}
?>
    </div>
  </div>
  
  <button type="submit" class="btn btn-primary form-control bg-success" name="manage-term">Manage Term</button>
</form>
              </form>
         </div>
    </div>

                           

<?php require "main-footer.php"; ?>
