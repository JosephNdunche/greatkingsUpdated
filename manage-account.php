<?php require "admin-header.php";
require "backend/manage-account.php";
?>

<div class="container mt-5 pt-5">

  <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="admin-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Manage Bank Account <i class="bi bi-people" style="font-size: 1.2rem; color: green;"></i></a></li>
                </ol>
  </nav>

            
<div class="card text-center">
            <div class="card-body pt-3">
              <div class="text-center">
              <i class="bi bi-exclamation-circle text-danger" style="font-size: 2.5rem;"></i>
              </div>
              <p>put in your account details for parents to make payment.</p>
      
              <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
              <div class="mb-3 mt-3">
    <input type="text" class="form-control" id="account_name" placeholder="Enter Account Name" name="account_name" value="<?php if(isset($account_name)){
        echo $account_name;
    } ?>">
    <div class="text-danger">
    <?php
if(isset($error['account_name'])){
  echo $error['account_name'];
}
?>
    </div>
  </div>

  <div class="mb-3 mt-3">
    <input type="text" class="form-control" id="account_number" placeholder="Enter Account Number" name="account_number" value="<?php if(isset($account_number)){
        echo $account_number;
    } ?>">
    <div class="text-danger">
    <?php
if(isset($error['account_number'])){
  echo $error['account_number'];
}
?>
    </div>
  </div>

  <div class="mb-3 mt-3">
    <input type="text" class="form-control" id="account_bank" placeholder="Enter account Bank" name="account_bank" value="<?php if(isset($account_bank)){
        echo $account_bank;
    } ?>">
    <div class="text-danger">
    <?php
if(isset($error['account_bank'])){
  echo $error['account_bank'];
}
?>
    </div>
  </div>

  
  <button type="submit" class="btn btn-primary form-control bg-success" name="manage-account">Manage Account</button>
</form>
              </form>
         </div>
    </div>

                           

<?php require "main-footer.php"; ?>
