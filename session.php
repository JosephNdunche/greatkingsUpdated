<?php session_start(); 

if(!isset($_SESSION['staff'])){
  header("location: staff-login.php");
}

?>