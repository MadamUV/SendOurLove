<?php
include 'header.php';
?><style>
body {
  text-align:center;
}
</style>
<?php
$message = "";
$msg = preg_replace('#[^a-z 0-9.:_()]#i', '', $_GET['msg']);
if($msg == "activation_failure"){
	$message = '<h2>Activation Error</h2> We apologize as there seems there was an issue activating your account at this time. We already notified ourselves of this issue and will contact you by email when we have identified the issue.';
        echo $message;
} else if($msg == "activation_success"){
	$message = '<h2>Activation Success</h2>Your account is now activated. <a href="login.php">Click here to log in. </a><br><br>Or set your security questions <a href="setupforgot.php">here</a>';
        echo $message;
} else {
	$message = $msg;
        echo $msg;
}
?>