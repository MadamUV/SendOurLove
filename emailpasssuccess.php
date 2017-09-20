<?php
   include 'php_includes/randStrGen.php';
   include 'php_includes/connect.php';
   $e = $_POST["emailaddress"];
   $temp = randStrGen(7);
   $temppass = crypt($temp, "567RT");
   $sql="UPDATE useroptions SET temp_pass='".$temppass."'";
   $query=mysqli_query($db_conx, $sql);
   		$to = "$e";							 
		$from = "donotreply@sendourlove.com";
		$subject = 'Log in with your temporary password';
		$message = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Message from SendOurLove.com</title><link rel="stylesheet" type="text/css" media="screen" href="http://www.sendourlove.com/style.css"><link rel="stylesheet" type="text/css" media="screen" href="http://www.sendourlove.com/webfonts/stylesheet.css"></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:10px; background:#333; font-size:24px; color:#CCC;"><a href="http://www.sendourlove.com"><img src="http://www.sendourlove.com/images/banner_eugene_golden.png" alt="send our love" style="border:none; float:left;"></a><link rel="stylesheet" type="text/css" media="screen" href="style.css"><link rel="stylesheet" type="text/css" media="screen" href="webfonts/stylesheet.css">New password</div><div style="padding:24px; font-size:17px;">Hi, '.$e.',<br /><br />Click the link below in order to generate a new temporary password. If you believe you may have received this email in error, please ignore this message.<br /><br /><a href="http://www.sendourlove.com/activatepass.php?e='.$e.'&pass='.$temppass.'&newliteralpass='.$temp.'">Click here to activate your new password, which will be '.$temp.'</a>';
		$headers = "From: $from\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
		mail($to, $subject, $message, $headers);
		echo "Success! Check your email at ".$e;
?>