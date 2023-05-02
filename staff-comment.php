<?php require "main-header.php"; ?>

<style>
    .bottom{
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: #fff;
    }
</style>

<?php
if(isset($_GET['comment_id'])){
    $comment_id = $_GET['comment_id'];
 }

  if(isset($_POST['comment_btn'])){
    $comment = $_POST['comment'];
    $comment_id = $_POST['comment_id'];
    $unique_id = $row['unique_id'];
    $sql = "INSERT INTO comment(post_id, comment, unique_id,date) VALUES(?,?,?,NOW());";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $comment_id, $comment, $unique_id);
    $stmt->execute();
  }

?>

<div class="container mt-5 pt-4">

<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="admin-dashboard.php"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Reply Post</a></li>
                </ol>
  </nav>
</div>

<div class="container-fluid"> 
  
 <section class="section dashboard mt-4">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

          <?php

            $sql = "SELECT * FROM comment WHERE post_id='$comment_id'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0){
              while($fetch = $result->fetch_assoc()){
                $user_id = $fetch['unique_id'];
                if(substr($user_id, 0, 1) === 's' || substr($user_id, 0, 1) === 'a'){
                    $sql1 = "SELECT * FROM staff WHERE unique_id='$user_id'";
                }
                else{
                    $sql1 = "SELECT * FROM users WHERE student_id='$user_id'";
                }
                $stmt1 = $conn->prepare($sql1);
                    $stmt1->execute();
                    $result1 = $stmt1->get_result();
                    if($result1->num_rows > 0){
                        $fetch_result = $result1->fetch_assoc();
          
      echo '

            <div class="comment_area bg-white mb-2 pb-4">
                <div class="row ps-2">
                    <div class="col-lg-4 d-flex pt-3 ">
                        <img src="uploads/'.$fetch_result['image'].'" style="width: 40px; height: 40px; border-radius: 20px;" alt="">
                        <div class="comment-text ms-3">
                            <h5>'.$fetch_result['lastname']. ' ' . $fetch_result['firstname'] .'</h5>
                            <p>'.$fetch['comment'].'</p>
                            <small>'.$fetch['date'].'</small>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

      ';

        } }}
         ?>
  
        </div><!-- End Right side columns -->

      </div>
    </section>


  <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="comment_form">
    <div class="form-group bottom">
        <div class="row">
            <div class="col-sm-12 d-flex justify-content-center align-items-center"> 
            <textarea name="comment" cols="25" rows="2" id="comment_name" class="" placeholder="Enter Comment"></textarea>
            <input type="hidden" name="comment_id" value="<?= $comment_id; ?>">
            <button class="btn btn-success ms-2" name="comment_btn"><i class="bi bi-send text-white"></i></button>
            </div>
        </div>
    </div>
  </form>

</div>



<?php require "comment-footer.php"; ?>