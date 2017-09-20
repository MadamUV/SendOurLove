<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Email new password</title>
       <?php
       include 'header.php';
       ?>
</head>
<body>
<div id="container">
  <div id="inner-main">
 <div id="uppernav">
    <table style="padding-left:10px">
    <td><a href="login.php">Home</a></td>
    <td><a href="friends.php">Friends</a></td>
    <td><a href="#">Tributes</a></td>
    <td><a href="gifts.php">Gifts</a></td>
    <td class="activetab"><a href="security.php?choice=true">Account</a></td>
    <td><p style="position:relative;float:right;padding-right:5%"><a href="logout.php">Log out</a></p></td></table>
    </div>
<span id="doneforgetting" align="center">
   <form method="post" action="emailpasssuccess.php">
      <input name="emailaddress" type="text">
      <button id="submit" type="submit">Send email</button>
   </form>
</span>
  </div>
</div>
</body>
</html>