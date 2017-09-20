<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $u; ?></title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="style.css">
<script src="js/main.js"></script>
<script src="js/ajax.js"></script>
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
<?php
  include 'header.php';
  include 'php_includes/connect.php';
  include_once("php_includes/check_login_status.php");
  $q = $_POST['secretquestion'];
  $a = $_POST['secretanswer'];
  //
              // Sanitize
                $quotes = array("\"", "'");
                $a = str_replace($quotes, "", $a);
                $q = str_replace($quotes, "", $q);
  if($user_ok == true){
    if(strlen($q) > 5 && strlen($a) > 2) {
      $sql = "UPDATE useroptions SET question='$q', answer='$a' WHERE username='".$_SESSION["username"]."' LIMIT 1";
      $query = mysqli_query($db_conx, $sql) or die ("Sorry, there was a problem processing your request.");
      echo '<span id="doneforgetting">Done! You have successfully updated your secret question/answer combination.</span>';
    }
    else {
      echo '<span id="doneforgetting">Please enter a longer question or answer</span>';
    }
  }
?>
  </div>
</div>
</body>
</html>