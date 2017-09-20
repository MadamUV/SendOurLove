<span id="doneforgetting">
<?php
$u=$_POST['username'];
include 'php_includes/connect.php';
$sql = "SELECT question, answer FROM useroptions WHERE username='$u' LIMIT 1";
$query = mysqli_query($db_conx, $sql);
$row = mysqli_fetch_row($query);
$num = mysqli_num_rows($query);
   if($num == 0) {
      echo '<p>Sorry, that username cannot be found.</p><p><a href="forgot.php">Back</a></p>';
   }
   else {
      echo 'Question: '.$row[0].'<br><form name="forgot" method="post" action="remembering.php?u='.$u.'"><input type="text" name="answer"><input type="hidden" name="u" value="'.$u.'"><button id="submit" type="submit">Submit answer</button></form><p>Forgot your secret answer? &nbsp;<a href="emailpass.php">Email yourself a new password.</a></p>';
   }
?>
</span>