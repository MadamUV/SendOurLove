<?php
include_once("php_includes/check_login_status.php");
include 'php_includes/connect.php';
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];
$u = $_GET['u'];
   if($pass1 == $pass2) {
   $pass1 = crypt($pass1, "567RT");
   $sql = "UPDATE users SET password='$pass1' WHERE username='$u' AND activated=1 LIMIT 1";
   $query = mysqli_query($db_conx, $sql);
   echo '<p>Success! You have set your new password.</p>&nbsp;<a href="login.php">Back</a>';
  }
  else {
     echo '<p>Your confirm password must match.</p><a href="remembering.php?u='.$u.'">Back</a>';
  }
?>