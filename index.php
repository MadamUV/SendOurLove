<?php
include_once("php_includes/check_login_status.php");
// If user is already logged in, header that person away
if($user_ok == true){
	header("location: user.php?u=".$_SESSION["username"]);
    exit();
}
?>
<!doctype html>
  <head><title>Send Our Love</title>
  </head>
  <body>
<div id="container">
  <div id="inner-main">
    <div id="header">
       <?php
       include 'header.php';
       ?>
    </div>
    <div id="uppernav"><p><a href="login.php">Sign up / Login</a></p>
    </div>
  </div>
</div>
</body>
</html>