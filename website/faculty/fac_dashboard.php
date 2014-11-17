<?php
	session_start();
	if($_SESSION["floggedin"] != TRUE) { //i.e. if faculty is not logged in
		header( 'Location: ./index.php' ) ; //One way to redirect
		die();
	}

?>
<html>
	
<head>
	<title>
		Faculty Dashboard - OnlineExaminer
	</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>

<body>

		<div align="right"> Welcome <?php echo $_SESSION["username"]; ?>! &nbsp;&nbsp;&nbsp;<a href="./logout.php"> Log Out </a></div> 
		<hr>
	<ul>
		<li><a href="add_ques.php">Add Question</a></li>
		<li><a href="create_test.php">Create Test</a></li>
	</ul>
	
	//option to add question
	//option to modify/delete previous questions if not attempted yet
	//option to make test
	  //randomly create test
	  //select ques for test
	//option to edit test if not given by student yet
	  
</body>

