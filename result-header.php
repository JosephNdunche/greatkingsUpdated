<?php
require "student-session.php"; 
require "database/connection.php";
require "backend/download-pdf.php";
require "backend/payment.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Great Kings Academy</title>
  <meta content="Our Vision and Mission is to discover and develop the potentials of every child through our individual centered teaching approach and raising intellectuals and God fearing Children." name="description">
  <meta content="greatkingsacademy, greatkings, great kings, great kings academy,Great Kings Academy" name="keywords">

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
              $staff_id = $_SESSION['student'];
              $sql = "SELECT * FROM users WHERE student_id=?";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param('s', $staff_id);
              $stmt->execute();
              $result = $stmt->get_result();
              if($result->num_rows > 0){
                $row = $result->fetch_assoc();
              }
              $stmt->close();
              ?>

 