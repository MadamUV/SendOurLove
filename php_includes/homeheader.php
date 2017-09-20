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
    <td class="activetab"><a href="login.php">Home</a></td>
    <td><a href="friends.php">Friends</a></td>
    <td><a href="#">Tributes</a></td>
    <td><a href="gifts.php">Gifts</a></td>
    <td><a href="security.php?choice=true">Account</a></td>
    <td><p style="position:relative;float:right;padding-right:5%"><a href="logout.php">Log out</a></p></td></table>
    </div>
    <?php include 'right-sidebar.php'; ?>
    <span id="doneforgetting"></span>
  </div>
</div>
</body>
</html>