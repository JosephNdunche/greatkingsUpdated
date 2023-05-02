<?php
require "session.php"; 
require "backend/profile-picture.php";
require "backend/manage-student-profile.php";
require "backend/view-student-profile.php";
require "backend/class-timetable.php";
require "backend/present.php";
require "backend/absent.php";
require "backend/teacher-comment.php";
require "backend/staff-update-result.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Great Kings Academy - Dashboard</title>
  <meta content="Our Vision and Mission is to discover and develop the potentials of every child through our individual centered teaching approach and raising intellectuals and God fearing Children." name="description">
  <meta content="great kings academy, great kings, nigerian schools, top 10 nigerian schools" name="keywords">

  <!-- Favicons -->
  <link href="assets/assets/img/favicon.png" rel="icon">
  <link href="assets/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/assets/css/style.css" rel="stylesheet">

</head>

<body>

<?php
              $staff_id = $_SESSION['staff'];
              $sql = "SELECT * FROM staff WHERE unique_id=?";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param('s', $staff_id);
              $stmt->execute();
              $result = $stmt->get_result();
              if($result->num_rows > 0){
                $row = $result->fetch_assoc();
              }
              $stmt->close();
              ?>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="dashboard.php" class="logo d-flex align-items-center">
        <img src="assets/assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Great Kings Academy</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->


        <?php
        if(isset($_POST['staff-notification'])){
          $not_sql = "UPDATE notification SET unset='1' WHERE unique_id=?";
          $not_stmt = $conn->prepare($not_sql);
          $not_stmt->bind_param('s', $staff_id);
          if($not_stmt->execute()){
            echo "<script>location.href = 'staff-notification.php';</script>";
          }
        }
        
        ?>


        <li class="nav-item dropdown">
        <?php 
            $staff_id = $_SESSION['staff'];
            $sql = "SELECT * FROM notification WHERE unique_id=? AND unset != '1'";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $staff_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $count = $result->num_rows;
            if($count === 0){
              $count = "";
            }

        ?>

<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
          <button type="submit" class="nav-link nav-icon btn" name="staff-notification">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number"><?php echo $count; ?></span>
            </button>
        </form>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have <?php echo $count; ?> new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <?php 
            $staff_id = $_SESSION['staff'];
            $sql = "SELECT * FROM notification WHERE unique_id=? ORDER BY notification_id DESC LIMIT 4";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('s', $staff_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows > 0){
              while($fetch = $result->fetch_assoc()){
                echo '
                <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>'.$row['lastname']. ' '. $row['firstname'].'</h4>
                <p>'.$fetch['message'].'</p>
                <p>'.$fetch['time'].'</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
                ';
              }
            }
            ?>
           
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown">

        <?php 
            $sql2 = "SELECT * FROM messages WHERE incoming_id='$staff_id' AND alert != '1'";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            $count2 = $result2->num_rows;
            if($count2 === 0){
              $count2 = "";
            }

        ?>

          <a class="nav-link nav-icon" href="staff-people.php">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number"><?= $count2; ?></span>
          </a><!-- End Messages Icon -->

          </li>

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="uploads/<?php echo $row['image']; ?>" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $row['lastname'] . ' ' . $row['firstname']; ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $row['lastname'] . ' ' . $row['firstname']; ?></h6>
              <span><?php echo $_SESSION['staff']; ?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="profile.php">
              <i class="bi bi-cloud-arrow-up"></i>
                <span>Edit Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="profile.php">
              <i class="bi bi-lock"></i>
                <span>Change Password</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link " href="profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-heading">Features</li>

      <li class="nav-item">
        <a class="nav-link " href="view-students.php">
          <i class="bi bi-people"></i>
          <span>Manage Student</span>
        </a>
      </li><!-- End View Students -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="staff-upload-result.php">
          <i class="bi bi-reception-4"></i>
          <span>Upload Result</span>
        </a>
      </li><!-- Manage Result -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="staff-manage-result.php">
          <i class="bi bi-controller"></i>
          <span>Manage Result</span>
        </a>
      </li><!-- Manage Result -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="edit-document.php">
          <i class="bi bi-border-all"></i>
          <span>Edit Document</span>
        </a>
      </li><!-- Manage Result -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="upload-library.php">
          <i class="bi bi-book"></i>
          <span>Upload Library</span>
        </a>
      </li><!-- Manage Library -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="class-timetable.php">
          <i class="bi bi-clock"></i>
          <span>Upload Time-Table</span>
        </a>
      </li><!-- Manage Library -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="assignment.php">
          <i class="bi bi-wallet"></i>
          <span>Upload Assignment</span>
        </a>
      </li><!-- End Manage Assignment -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="upload-note.php">
          <i class="bi bi-book"></i>
          <span>Upload Lecture Note</span>
        </a>
      </li><!-- End Manage Assignment -->

    </ul>

  </aside><!-- End Sidebar-->