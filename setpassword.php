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
<p>
  <?php include 'right-sidebar.php' ?>
</p>
<div id="changepass">
  <form name="passform" id="passform" action="setpasswordsuccess.php" method="post">
    <div>Username:</div>
    <input id="username" name="username" type="text">
    <div>Current password:</div>
    <input id="oldpass" name="oldpass" type="password">
    <div>New password:</div>
    <input id="pass1" name="pass1" type="password" onfocus="emptyElement('status')" maxlength="16">
    <div>Confirm Password:</div>
    <input id="pass2" name="pass2" type="password" onfocus="emptyElement('status')" maxlength="16">
    <button id="passsubmit" type="submit" value="Submit">Change password</button>
  </form>