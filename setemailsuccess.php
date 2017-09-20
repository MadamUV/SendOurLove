<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $u; ?></title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="style.css">
</head>
<body>
<div id="container">
  <div id="inner-main">
    <div id="header">
       <?php
       include 'header.php';
       ?>
    </div>
 <div id="uppernav">
    <table style="padding-left:10px">
    <td><a href="login.php">Home</a></td>
    <td><a href="friends.php">Friends</a></td>
    <td><a href="#">Tributes</a></td>
    <td><a href="gifts.php">Gifts</a></td>
    <td class="activetab"><a href="security.php?choice=true">Account</a></td>
    <td><p style="position:relative;float:right;padding-right:5%"><a href="logout.php">Log out</a></p></td></table>
    </div>
<span id="doneforgetting">
<?php
include_once("php_includes/check_login_status.php");

if($user_ok == true)
{
	// CONNECT TO THE DATABASE
	include_once("php_includes/connect.php");
	// GATHER THE POSTED DATA INTO LOCAL VARIABLES AND SANITIZE
     $p = mysqli_real_escape_string($db_conx, $_POST['password']);
     $n = mysqli_real_escape_string($db_conx, $_POST['newemail']);
     $c = mysqli_real_escape_string($db_conx, $_POST['confirmemail']);
     $p = crypt($p, "567RT");
     $sql = "SELECT password FROM users WHERE username='".$_SESSION["username"]."' AND activated='1' LIMIT 1";
    $myquery = mysqli_query($db_conx, $sql);
    $row = mysqli_fetch_row($myquery);
    if($p == $row[0]) {
      if($n == $c) {
        $sql = "UPDATE users SET email='$n' WHERE username='".$_SESSION["username"]."' AND activated='1' LIMIT 1";
        $myquery = mysqli_query($db_conx, $sql);        
        echo 'You have successfully changed your email.<a href="login.php">&nbsp;Back</a>';
      }
      else
    { 
       echo 'Your emails do not match.<a href="setemail.php">&nbsp;Try again.</a>';
    }
  }
  else {
      echo 'Password incorrect.<a href="setemail.php">&nbsp;Try again.</a>';
  }
}
else {
   header("location: login.php");
   exit();
}
?>
</span>
  </div>
</div>
</body>
</html>