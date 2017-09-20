<!doctype html>
<head><title>Security questions</title>
<script src="js/main.js"></script>
<script src="js/ajax.js"></script>
<style type="text/css">
@font-face {
    font-family: 'architects_daughterregular';
    src: url('webfonts/architectsdaughter-webfont.eot');
    src: url('webfonts/architectsdaughter-webfont.eot?#iefix') format('embedded-

opentype'),
         url('webfonts/architectsdaughter-webfont.woff') format('woff'),
         url('webfonts/architectsdaughter-webfont.ttf') format('truetype'),
         url('webfonts/architectsdaughter-webfont.svg#architects_daughterregular') 

format('svg');
    font-weight: normal;
    font-style: normal;
}
#submit {
  font-family:'architects_daughterregular', Arial, sans-serif;
}
</style>
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
    <td class="activetab"><a href="security.php">Account</a></td>
    <td><p style="position:relative;float:right;padding-right:5%"><a 

href="logout.php">Log out</a></p></td></table>
    </div>
    <div id="questions">
<table>
<td>
<p>
<?php
   if($_GET['choice'] == 'true') {
      echo 'You requested to change your security questions.';
   }
   else echo 'Before continuing, we recommend you make a secret question and answer 

for your account if you need to retrieve your password.';
?>
</p></td>
<td>
<p><form id="setupform" action="setupresult.php" method="post">
    <div>Secret question:</div>
    <input type="text" name="secretquestion" id="secretquestion" maxlength="340">
    <div>Secret answer:</div>
    <input type="text" name="secretanswer" id="secretanswer" maxlength="340">
    <br /><br />
    <button id="submit" type="submit">Submit question and answer</button>
  </form></p></td></table>
<p><a href="security.php">Back</a></p>
  </div>
  </div>
</div>
</body>
</html>