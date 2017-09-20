<?php
   include 'php_includes/connect.php';
   $answer = $_POST['answer'];
   $u = $_GET['u'];
   $sql = "SELECT * FROM useroptions WHERE username='".$u."' AND answer='".$answer."' LIMIT 1";
   $query = mysqli_query($db_conx, $sql);
   $num = mysqli_num_rows($query);
   if($num == 0) {
      echo '<p>Sorry, that answer cannot be found for your username.</p><p><form method="post" action="forgot.php" name="back"><input type="hidden" name="username" value="'.$u.'"><button name="submit" type="submit">Back</button></form></p>';
   }
   else {
      echo '<div id="changepass"><form name="passform" id="passform" action="rememberingsuccess.php?u='.$u.'" method="post"><div>New password:</div><input id="pass1" name="pass1" type="password"><div>Confirm Password:</div><input id="pass2" name="pass2" type="password"><button id="passsubmit" type="submit" value="Submit">Change password</button></form></div>';
   }
?>