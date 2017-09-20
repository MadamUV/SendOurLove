<!doctype html>
<head><title>Security</title></head>
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
    <td><a href="user.php">Home</a></td>
    <td><a href="friends.php">Friends</a></td>
    <td><a href="#">Tributes</a></td>
    <td><a href="gifts.php">Gifts</a></td>
    <td class="activetab"><a href="setupforgot.php?choice=true">Account</a></td>
    <td><p style="position:relative;float:right;padding-right:5%"><a href="logout.php">Log out</a></p></td></table>
    </div>
<p>
  <?php include 'right-sidebar.php' ?>
</p>
    <div id="securityoptions">
<p class="welcome">
Welcome to your account center.
</p>
<table>
<td><a href="setupforgot.php?choice=true">Set questions</a><br><a href="setpassword.php">Change password</a></td><td><a href="setemail.php">Change email</a><br><a href="deleteaccount.php">Delete account</a></td>
</table>
  </div>
  </div>
</div>
</body>
</html>