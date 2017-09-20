<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $u; ?></title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="style.css">
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
    <td class="activetab"><a href="security.php?choice=true">Account</a></td>
    <td><p style="position:relative;float:right;padding-right:5%"><a href="logout.php">Log out</a></p></td></table>
    </div>
<span id="doneforgetting">
<?php
	// CONNECT TO THE DATABASE
	include_once("php_includes/connect.php");
	// GATHER THE POSTED DATA INTO LOCAL VARIABLES AND SANITIZE
        $u = mysqli_real_escape_string($db_conx, $_POST['username']);
	$o = mysqli_real_escape_string($db_conx, $_POST['oldpass']);
        $p1 = mysqli_real_escape_string($db_conx, $_POST['pass1']);
        $p2 = mysqli_real_escape_string($db_conx, $_POST['pass2']);
	$o = crypt($o, "567RT");
	// GET USER IP ADDRESS
    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	// FORM DATA ERROR HANDLING
	if($o == "" || $p1 == ""  || $p2 == "" || $u == ""){
		echo "Incorrect credentials. Please try again.";
        exit();
	} else {
	// END FORM DATA ERROR HANDLING
		$sql = "SELECT id, username, password FROM users WHERE username='$u' AND activated=1 LIMIT 1";
        $query = mysqli_query($db_conx, $sql);
        $row = mysqli_fetch_row($query);
		$db_id = $row[0];
		$db_username = $row[1];
        $db_pass_str = $row[2];
		if($o != $db_pass_str){
			echo "Incorrect login<p><a href='security.php'>Back</a></p>";
            exit();
		} else {
                    $p1 = crypt($p1, "567RT");
                    $sql = "UPDATE users SET password='$p1' WHERE username='$u' AND activated=1 LIMIT 1";
                    $query = mysqli_query($db_conx, $sql);
                    echo 'Success! &nbsp;<a href="login.php">Home</a>';
                    sleep(5);
		    header("location: user.php?".$_SESSION["username"]);
		}
            exit();
	}
?>
</span>
  </div>
</div>
</body>
</html>