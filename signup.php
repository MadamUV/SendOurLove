<!-- ********************************** -->
<!-- *********** signup.php *********** -->
<!-- ********************************** -->
<?php
include 'header.php';
session_start();
// If user is logged in, header them away
if(isset($_SESSION["username"])){
	header("location: message.php?msg=no");
    exit();
}
?><?php
// Ajax calls this NAME CHECK code to execute
if(isset($_POST["usernamecheck"])){
	include_once("php_includes/connect.php");
	$username = preg_replace('#[^a-z0-9]#i', '', $_POST['usernamecheck']);
	$sql = "SELECT id FROM users WHERE username='$username' LIMIT 1";
    $query = mysqli_query($db_conx, $sql); 
    $uname_check = mysqli_num_rows($query);
    if (strlen($username) < 3 || strlen($username) > 16) {
	    echo '<strong style="color:#F00;">3 - 16 characters please</strong>';
	    exit();
    }
	if (is_numeric($username[0])) {
	    echo '<strong style="color:#F00;">Usernames must begin with a letter</strong>';
	    exit();
    }
    if ($uname_check < 1) {
	    echo '<strong style="color:#009900;">' . $username . ' is OK</strong>';
	    exit();
    } else {
	    echo '<strong style="color:#F00;">' . $username . ' is taken</strong>';
	    exit();
    }
}
?><?php
// Ajax calls this REGISTRATION code to execute
if(isset($_POST["u"])){
	// CONNECT TO THE DATABASE
	include_once("php_includes/connect.php");
	// GATHER THE POSTED DATA INTO LOCAL VARIABLES
	$u = preg_replace('#[^a-z0-9]#i', '', $_POST['u']);
	$e = mysqli_real_escape_string($db_conx, $_POST['e']);
	$p = $_POST['p'];
	$g = preg_replace('#[^a-z]#', '', $_POST['g']);
	$c = preg_replace('#[^a-z ]#i', '', $_POST['c']);
	// GET USER IP ADDRESS
    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	// DUPLICATE DATA CHECKS FOR USERNAME AND EMAIL
	$sql = "SELECT id FROM users WHERE username='$u' LIMIT 1";
    $query = mysqli_query($db_conx, $sql); 
	$u_check = mysqli_num_rows($query);
	// -------------------------------------------
	$sql = "SELECT id FROM users WHERE email='$e' LIMIT 1";
    $query = mysqli_query($db_conx, $sql); 
	$e_check = mysqli_num_rows($query);
	// FORM DATA ERROR HANDLING
	if($u == "" || $e == "" || $p == "" || $g == "" || $c == ""){
		echo "The form submission is missing values.";
        exit();
	} else if ($u_check > 0){ 
        echo "The username you entered is alreay taken";
        exit();
	} else if ($e_check > 0){ 
        echo "That email address is already in use in the system";
        exit();
	} else if (strlen($u) < 3 || strlen($u) > 16) {
        echo "Username must be between 3 and 16 characters";
        exit(); 
    } else if (is_numeric($u[0])) {
        echo 'Username cannot begin with a number';
        exit();
    } else {
	// END FORM DATA ERROR HANDLING
	    // Begin Insertion of data into the database
            // Sanitize
                $toinsert = array('$u','$e','$p','$g','$c','$ip');
                $quotes = array('\'','"');
                for ($i=0; $i<count($toinsert); $i++) {
                  $toinsert[$i] = addslashes($toinsert[$i]);
                }
		// Hash the password and apply your own mysterious unique salt
		$p_hash = crypt($p, "567RT");
		// Add user info into the database table for the main site table
		$sql = "INSERT INTO users (username, email, password, gender, country, ip, signup, lastlogin, notescheck)       
		        VALUES('$u','$e','$p_hash','$g','$c','$ip',now(),now(),now())";
		$query = mysqli_query($db_conx, $sql); 
		$uid = mysqli_insert_id($db_conx);
		// Establish their row in the useroptions table
		$sql = "INSERT INTO useroptions (id, username, background) VALUES ('$uid','$u','original')";
		$query = mysqli_query($db_conx, $sql);
		// Create directory(folder) to hold each user's files(pics, MP3s, etc.)
		if (!file_exists("user/$u")) {
			mkdir("user/$u", 0755);
		}
		// Email the user their activation link
		$to = "$e";							 
		$from = "donotreply@sendourlove.com";
		$subject = 'SendOurLove Account Activation';
		$message = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Message from SendOurLove.com</title><link rel="stylesheet" type="text/css" media="screen" href="http://www.sendourlove.com/style.css"><link rel="stylesheet" type="text/css" media="screen" href="http://www.sendourlove.com/webfonts/stylesheet.css"></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:10px; background:#333; font-size:24px; color:#CCC;"><a href="http://www.sendourlove.com"><img src="http://www.sendourlove.com/images/banner_eugene_golden.png" alt="send our love" style="border:none; float:left;"></a><link rel="stylesheet" type="text/css" media="screen" href="style.css"><link rel="stylesheet" type="text/css" media="screen" href="webfonts/stylesheet.css">SendOurLove Account Activation</div><div style="padding:24px; font-size:17px;">Hello '.$u.',<br /><br />Click the link below to activate your account when ready:<br /><br /><a href="http://www.sendourlove.com/activation.php?id='.$uid.'&u='.$u.'&e='.$e.'&p='.$p_hash.'">Click here to activate your account now</a><br /><br />Login after successful activation using your:<br />* E-mail Address: <b>'.$e.'</b></div></body></html>';
		$headers = "From: $from\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
		mail($to, $subject, $message, $headers);
		echo "Success! Check your email at".$e;
		exit();
	}
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Sign Up</title>
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
#signupform{
	margin-top:24px;	
}
#signupform > div {
	margin-top: 12px;	
}
#signupform > input,select {
	width: 200px;
	padding: 3px;
	background: #F3F9DD;
}
#signupbtn {
	font-size:18px;
	padding: 12px;
        font-family: 'architects_daughterregular', Arial, sans-serif; 
}
</style>
<script src="js/main.js"></script>
<script src="js/ajax.js"></script>
<script>
function restrict(elem){
	var tf = _(elem);
	var rx = new RegExp;
	if(elem == "email"){
		rx = /[' "]/gi;
	} else if(elem == "username"){
		rx = /[^a-z0-9]/gi;
	}
	tf.value = tf.value.replace(rx, "");
}
function emptyElement(x){
	_(x).innerHTML = "";
}
function checkusername(){
	var u = _("username").value;
	if(u != ""){
		_("unamestatus").innerHTML = 'checking ...';
		var ajax = ajaxObj("POST", "signup.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            _("unamestatus").innerHTML = ajax.responseText;
	        }
        }
        ajax.send("usernamecheck="+u);
	}
}
function signup(){
	var u = _("username").value;
	var e = _("email").value;
	var p1 = _("pass1").value;
	var p2 = _("pass2").value;
	var c = _("country").value;
	var g = _("gender").value;
	var status = _("status");
	if(u == "" || e == "" || p1 == "" || p2 == "" || c == "" || g == ""){
		status.innerHTML = "Fill out all of the form data";
	} else if(p1 != p2){
		status.innerHTML = "Your password fields do not match";
	} else {
		_("signupbtn").style.display = "none";
		status.innerHTML = 'please wait ...';
		var ajax = ajaxObj("POST", "signup.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            if(ajax.responseText != "signup_success"){
					status.innerHTML = ajax.responseText;
					_("signupbtn").style.display = "block";
				} else {
					window.scrollTo(0,0);
					_("signupform").innerHTML = "OK "+u+", please check your email inbox and junk mail box at <u>"+e+"</u> now or at your leisure to complete sign up. You will be able to access our community once you do this.";
				}
	        }
        }
        ajax.send("u="+u+"&e="+e+"&p="+p1+"&c="+c+"&g="+g);
	}
}
/* function addEvents(){
	_("elemID").addEventListener("click", func, false);
}
window.onload = addEvents; */
</script>
</head>
<body>
<div id="container">
  <div id="inner-main">
    <div id="header">
       <?php
       include 'header.php';
       ?>
    </div>
    <div id="uppernav"><p>Sign up</p></div>
  <div id="questionssignup">
  <form name="signupform" id="signupform" onsubmit="return false;">
    <table class="mysignup" cellpadding="20">
    <td>
    <div>Username: </div>
    <input id="username" type="text" onblur="checkusername()" onkeyup="restrict('username')" maxlength="16">
    <span id="unamestatus"></span>
    <div>Email Address:</div>
    <input id="email" type="text" onfocus="emptyElement('status')" onkeyup="restrict('email')" maxlength="88">
    <div>Create Password:</div>
    <input id="pass1" type="password" onfocus="emptyElement('status')" maxlength="16">
    <div>Confirm Password:</div>
    <input id="pass2" type="password" onfocus="emptyElement('status')" maxlength="16">
    </td>
    <td>
    <div>Gender:</div>
    <select id="gender" onfocus="emptyElement('status')">
      <option value=""></option>
      <option value="m">Male</option>
      <option value="f">Female</option>
    </select>
    <div>Country:</div>
    <select id="country" onfocus="emptyElement('status')">
      <?php include_once("php_includes/country.php"); ?>
    </select>
    <br /><br />
    <button id="signupbtn" onclick="signup()">Create Account</button>
    <span id="status"></span>
    </span>
    </td>
    </table>
  </form>
  </div>
  </div>
</div>
</body>
</html>