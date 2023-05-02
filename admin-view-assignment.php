<?php
require "admin-header.php";
?>

<?php
if(isset($_GET['assignment_id'])){
  $assignment_id = $_GET['assignment_id'];
 }

if(isset($_POST['delete-assignment-btn'])){

  $assignment_id = $_POST['assignment_id'];
  $del_sql = "DELETE FROM assignment WHERE assignment_id=?";
  $del_stmt = $conn->prepare($del_sql);
  $del_stmt->bind_param('s', $assignment_id);
  if($del_stmt->execute()){
    echo "<script>location.href = 'delete-assignment.php';</script>";

  }
}


 $sql = "SELECT * FROM  assignment WHERE assignment_id='$assignment_id'";
 $stmt = $conn->prepare($sql);
 $stmt->execute();
 $result = $stmt->get_result();
 if($result->num_rows > 0){
   $data = $result->fetch_assoc(); 
   $staff_id = $data['staff_id'];
   $sql1 = "SELECT * FROM  staff WHERE unique_id='$staff_id'";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute();
    $staff_result = $stmt1->get_result();
    if($staff_result->num_rows > 0){
      $staff_data = $staff_result->fetch_assoc(); 
      $lastname = $staff_data['lastname'];
      $firstname = $staff_data['firstname'];
    }
  }
?>

<main id="main" class="main">

    <div class="pagetitle">
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Manage Assignment</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-6">

          <div class="card">
            <div class="card-body mt-3">
              <p>Course Name: <span class="text-success fw-bold"><?= $data['subject']; ?></span><br />
              Staff Name: <span class="text-success fw-bold"><?= $lastname .' '. $firstname; ?></span><br />
              Class: <span class="text-success fw-bold"><?= $data['class']; ?></span><br />
              Date Uploaded: <span class="text-success fw-bold"><?= $data['date']; ?></span>
              Deadline: <span class="text-success fw-bold"><?= $data['deadline']; ?></span>
            </p>


              <textarea class="tinymce-editor">
            <?= $data['assignment']; ?>
            </textarea>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <input type="hidden" name="assignment_id" value="<?= $assignment_id; ?>">
            <button class="btn btn-success mt-3" name="delete-assignment-btn">Delete Assignment</button>
            </form>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

<?php
require "main-footer.php";
?>