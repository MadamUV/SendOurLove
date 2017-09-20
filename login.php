<?php
include_once("php_includes/check_login_status.php");
// If user is already logged in, header that person away
if($user_ok == true){
	header("location: user.php?u=".$_SESSION["username"]);
    exit();
}
?><?php
// AJAX CALLS THIS LOGIN CODE TO EXECUTE
if(isset($_POST["u"])){
	// CONNECT TO THE DATABASE
	include_once("php_includes/connect.php");
	// GATHER THE POSTED DATA INTO LOCAL VARIABLES AND SANITIZE
	$u = mysqli_real_escape_string($db_conx, $_POST['u']);
        $p = mysqli_real_escape_string($db_conx, $_POST['p']);
	$p = crypt($p, "567RT");
	// GET USER IP ADDRESS
    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	// FORM DATA ERROR HANDLING
	if($u == "" || $p == ""){
		echo "login_failed";
        exit();
	} else {
	// END FORM DATA ERROR HANDLING
		$sql = "SELECT id, username, password FROM users WHERE username='$u' AND activated=1 LIMIT 1";
        $query = mysqli_query($db_conx, $sql);
        $row = mysqli_fetch_row($query);
		$db_id = $row[0];
		$db_username = $row[1];
        $db_pass_str = $row[2];
		if($p != $db_pass_str){
			echo "Incorrect login";
            exit();
		} else {
			// CREATE THEIR SESSIONS AND COOKIES
			$_SESSION['userid'] = $db_id;
			$_SESSION['username'] = $db_username;
			$_SESSION['password'] = $db_pass_str;
			setcookie("id", $db_id, strtotime( '+30 days' ), "/", "", "", TRUE);
			setcookie("user", $db_username, strtotime( '+30 days' ), "/", "", "", TRUE);
    		setcookie("pass", $db_pass_str, strtotime( '+30 days' ), "/", "", "", TRUE); 
			// UPDATE THEIR "IP" AND "LASTLOGIN" FIELDS
			$sql = "UPDATE users SET ip='$ip', lastlogin=now() WHERE username='$db_username' LIMIT 1";
            $query = mysqli_query($db_conx, $sql);
			echo $db_username;
		    exit();
		}
	}
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Log In</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="style/style.css">
<style type="text/css">
@font-face {
    font-family: 'architects_daughterregular';
    src: url('webfonts/architectsdaughter-webfont.eot');
    src: url('webfonts/architectsdaughter-webfont.eot?#iefix') format('embedded-opentype'),
         url('webfonts/architectsdaughter-webfont.woff') format('woff'),
         url('webfonts/architectsdaughter-webfont.ttf') format('truetype'),
         url('webfonts/architectsdaughter-webfont.svg#architects_daughterregular') format('svg');
    font-weight: normal;
    font-style: normal;
}
body {
  font-family: 'architects_daughterregular', Arial, sans-serif;
}
#loginform{
	margin-top:24px;
        width:45%;
}
#loginform > div {
	margin-top: 12px;	
}
#loginform > input {
	width: 200px;
	padding: 3px;
	background: #F3F9DD;
}
#loginbtn {
	font-size:15px;
	padding: 10px;
        font-family: 'architects_daughterregular', Arial, sans-serif;
}
</style>
<script src="js/main.js"></script>
<script src="js/ajax.js"></script>
<script>
function emptyElement(x){
	_(x).innerHTML = "";
}
function login(){
	var u = _("username").value;
	var p = _("password").value;
	if(u == "" || p == ""){
		_("status").innerHTML = "Fill out all of the form data";
	} else {
		_("loginbtn").style.display = "none";
		_("status").innerHTML = 'please wait ...';
		var ajax = ajaxObj("POST", "login.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            if(ajax.responseText == "login_failed"){
					_("status").innerHTML = "Login unsuccessful, please try again.";
					_("loginbtn").style.display = "block";
				} else {
					window.location = "user.php?u="+ajax.responseText;
				}
	        }
        }
        ajax.send("u="+u+"&p="+p);
	}
}
</script>
</head>
<body>
<body>
<div id="container">
  <div id="inner-main">
    <div id="header">
       <?php
       include 'header.php';
       ?>
    </div>
    <div id="uppernav"><p>Log in</p></div>
  </div>
  <div id="loginandsidenav">
  <div class="login">
  <!-- LOGIN FORM -->
  <form id="loginform" onsubmit="return false;">
    <div>Username:</div>
    <input type="text" id="username" onfocus="emptyElement('status')" maxlength="88">
    <div>Password:</div>
    <input type="password" id="password" onfocus="emptyElement('status')" maxlength="100">
    <br /><br />
    <button id="loginbtn" onclick="login()">Log In</button> 
    <p id="status"></p>
    <a href="enterusername.php">Forgot Your Password?</a>
  </form>
  <!-- LOGIN FORM -->
  </div>
  <p id="getaccount">Don't have a SendOurLove account? <br><a href="signup.php">Sign up</a></p>
</div>
</div>
</body>
</body>
</html>