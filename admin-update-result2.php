<?php
require "admin-header.php";
?>

<section class="signup py-4 mb-5">
<h2 class="text-">Update Result</h2>
<div class="container">
  
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

  <div class="mb-3 mt-3">
  <?php
    $student_query = "SELECT * FROM users WHERE student_id = ?";
    $student_stmt = $conn->prepare($student_query);
    $student_stmt->bind_param('s', $student_id);
    $student_stmt->execute();
    $student_result = $student_stmt->get_result();
    if($student_result->num_rows > 0){
        $student_rows = $student_result->fetch_assoc();
        $student_names = $student_rows['lastname'] . ' ' . $student_rows['firstname'];
        $student_uid = $student_rows['student_id'];
        $student_class = $student_rows['class'];
        
    }
    ?>
  <?php 
  echo '
    <p>Student Name: <span class="text-success">'.$student_names.'</span><br />
    Student Uid: <span class="text-success">'.$student_uid.'</span><br />
    Student Class: <span class="text-success">'.$student_class.'</span><br />
    </p>
  ';
  ?>
    <select name="section" id="section" class="form-control">
        <option value="<?php
    if(isset($student_session)){
      echo $student_session;
    }else{
      echo "";
    }
    ?>"><?php
    if(isset($student_session)){
      echo $student_session;
    }else{
      echo "Select Section";
    }
    ?></option>
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
    <div class="text-danger">
    <?php
if(isset($error['section'])){
  echo $error['section'];
}
?>
    </div>
  </div>
  
  <div class="mb-3">
    <select name="term" id="term" class="form-control">
    <option value="<?php
    if(isset($student_term)){
      echo $student_term;
    }else{
      echo "";
    }
    ?>"><?php
    if(isset($student_term)){
      echo $student_term;
    }else{
      echo "Select Term";
    }
    ?></option>
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
    <div class="text-danger">
    <?php
if(isset($error['term'])){
  echo $error['term'];
}
?>
    </div>
  </div>

  <div class="mb-3">
    <select name="course" id="course" class="form-control">
    <option value="<?php
    if(isset($student_course)){
      echo $student_course;
    }else{
      echo "";
    }
    ?>"><?php
    if(isset($student_course)){
      echo $student_course;
    }else{
      echo "Select Course";
    }
    ?></option>
        <?php
                      $sql_course = "SELECT courses FROM course";
                      $course_stmt = $conn->prepare($sql_course);
                      $course_stmt->execute();
                      $course_result = $course_stmt->get_result();
                      if($course_result->num_rows > 0){
                        while($course_row = $course_result->fetch_assoc()){
                          echo '
                          <option value='.$course_row['courses'].'>'.$course_row['courses'].'</option>
                          ';
                        }
                      }
                      ?>
    </select>
    <div class="text-danger">
    <?php
if(isset($error['course'])){
  echo $error['course'];
}
?>
    </div>
  </div>

  <div class="mb-3">
    <input type="tel" class="form-control" name="first_term_score" id="first_term_score" value="<?php
    if(isset($student_first_term_score)){
      echo $student_first_term_score;
    }else{
      echo "Enter First Term Score(100%)";
    }
    ?>" name="first_term_score">
    <div class="text-danger">
    <?php
if(isset($error['first_term_score'])){
  echo $error['first_term_score'];
}
?>
    </div>
  </div>

  <div class="mb-3">
    <input type="tel" class="form-control" name="second_term_score" id="second_term_score" value="<?php
    if(isset($student_second_term_score)){
      echo $student_second_term_score;
    }else{
      echo "Enter Second Term Score(100%)";
    }
    ?>">
    <div class="text-danger">
    <?php
if(isset($error['second_term_score'])){
  echo $error['second_term_score'];
}
?>
    </div>
  </div>


  <div class="mb-3">
    <input type="tel" class="form-control" id="test_score" placeholder="Enter Test Score" name="test_score">
    <div class="text-danger">
    <?php
if(isset($error['test_score'])){
  echo $error['test_score'];
}
?>
    </div>
  </div>

  <div class="mb-3">
    <input type="tel" class="form-control" id="exam_score" placeholder="Enter Exam Score" name="exam_score">
    <div class="text-danger">
    <?php
if(isset($error['exam_score'])){
  echo $error['exam_score'];
}
if(isset($error['check'])){
  echo $error['check'];
}
?>
    </div>
  </div>
  <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
  <input type="hidden" name="student_course" value="<?php echo $student_course; ?>">
  <input type="hidden" name="student_session" value="<?php echo $student_session; ?>">
  <input type="hidden" name="student_term" value="<?php echo $student_term; ?>">
  <input type="hidden" name="student_first_term_score" value="<?php echo $student_first_term_score; ?>">
  <input type="hidden" name="student_second_term_score" value="<?php echo $student_second_term_score; ?>">
  
  <button type="submit" class="btn btn-primary form-control bg-success" name="result-btn2">Upload Result</button>
</form>
</div>
</section>

<?php require_once "main-footer.php";  ?>