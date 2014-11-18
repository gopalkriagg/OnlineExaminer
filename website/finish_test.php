<?php
	session_start();
	if($_SESSION["sloggedin"] != TRUE) { //i.e. if student is not logged in
		header( 'Location: ./index.php' ) ; //One way to redirect
		die();
	}

?>

<?php


$servername = "localhost";
$username = "root";
$password = "sqlpass";
$db="OnlineExaminer";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$idTest=$_SESSION['quiz'];






?>

<html>
  <head>
    <title>Quiz <?php echo "$idTest";;?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">


  </head>
  <body>
   









  </body>

</html>