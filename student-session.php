<?php session_start(); 

if(!isset($_SESSION['student'])){
  header("location: student-login.php");
}

?>