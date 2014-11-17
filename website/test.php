<?php
// test.php displays all the possible tests the student can give
	session_start();
	if($_SESSION["sloggedin"] != TRUE) { //i.e. if student is not logged in
		header( 'Location: ./index.php' ) ; //One way to redirect
		die();
	}

?>
<html>
<head>
	<title>
		Home - OnlineExaminer
	</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>


<body>
	
	<?php
	
	include 'database_connect.php';
	$sql = "SELECT id FROM TESTS WHERE NOT EXISTS ( SELECT testID FROM STU_RECORD WHERE stuID = '$_SESSION[userid]')";

	
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		// output data of each row
		echo "Select the test that you want to appear for:"."<br>";
	    echo "
	    <FORM name =\"test\" method =\"post\" action =\"testconductor.php\"
	
	    ";
	    while($row = $result->fetch_assoc()) {
	     echo "<br> ID: ". $row["id"]. "&nbsp|&nbsp Set By: ". $row["setBy"]. "&nbsp|&nbsp <a href=\"testconductor.php?idTest=$row[id] \"> Give Test </a>";    
	    }
	} else {
	    echo "There are no tests schduled";
	}
	
	
	
	
	?>
	
	<a href="testconductor.php">Test conductor</a>
	
</body>
</html>
