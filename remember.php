<?php
    $answer = $_POST['answer'];
              // Sanitize
                $quotes = array("\"", "'");
                $answer = str_replace($quotes, "", $answer);
   include 'php_includes/connect.php';
   $sql = "SELECT answer FROM useroptions WHERE username='".$_SESSION["username"]."' AND activated='1' LIMIT 1";
  $query = mysqli_query($db_conx, $sql);
  $row = mysqli_fetch_row($query);
  if ($row[0] == $answer) {
     header("location: remembering.php");
  }
  else {
     echo '<p>There seems to be a problem. Please try again.</p>&nbsp;<a href="forgot.php">Back</a>';
  }
?>