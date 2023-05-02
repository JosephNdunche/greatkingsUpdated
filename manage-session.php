<?php require "admin-header.php";
require "backend/manage-session.php";
?>

<div class="container mt-5 pt-5">

<div class="row justify-content-center">

  <div class="col-lg-4">

  <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="admin-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Manage Session <i class="bi bi-people" style="font-size: 1.2rem; color: green;"></i></a></li>
                </ol>
  </nav>

            
<div class="card text-center">
            <div class="card-body pt-3">
              <div class="text-center">
              <i class="bi bi-exclamation-circle text-success" style="font-size: 2.5rem;"></i>
              </div>
              <p>Select the current session.</p>
      
              <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
              <div class="mb-3 mt-3">

                <select name="session" id="session" class="form-control">
                    <?php
                    $sql = "SELECT session FROM session";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if($result->num_rows > 0){
                        echo '<option value="">Select session</option>';
                        while($get_result = $result->fetch_assoc()){
                        echo '
                        <option value='.$get_result['session'].'>'.$get_result['session'].'</option>
                    ';
                    }
                }
                    ?>
                </select>
    <div class="text-danger pt-3">
    <?php
if(isset($error['session'])){
  echo $error['session'];
}
?>
    </div>
  </div>
  
  <button type="submit" class="btn btn-primary form-control bg-success" name="manage-session">Manage Session</button>
</form>
              </form>
         </div>
    </div>
  </div>
</div>
                           

<?php require "main-footer.php"; ?>
