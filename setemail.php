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
  <form name="setpass" id="setpass" method="post" action="setemailsuccess.php">
    <table cellpadding="10">
    <td>
    <div>Password:</div>
    <input id="password" name="password" type="password" onfocus="emptyElement('status')">
    </td>
    <td>
    <div>New email:</div>
    <input id="newemail" name="newemail" type="text" onfocus="emptyElement('status')" maxlength="36">
    <div>Confirm email:</div>
    <input id="confirmemail" name="confirmemail" type="text" onfocus="emptyElement('status')" maxlength="36">
    <button id="passsubmit" type="submit" value="Submit">Change email</button>
    </td>
    </table>
  </form>
</div>