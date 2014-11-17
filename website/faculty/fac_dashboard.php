<?php
	session_start();
	if($_SESSION["sloggedin"] != TRUE) { //i.e. if student is not logged in
		header( 'Location: ./index.php' ) ; //One way to redirect
		die();
	}

?>
<html>
	
<head>
	<title>
		Home
	</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>

