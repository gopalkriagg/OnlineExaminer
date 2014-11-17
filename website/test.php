<html>
<head>
	<title>
		Home
	</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>



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



$sql = "SELECT 'id' FROM 'TESTS' WHERE NOT EXISTS ( SELECT 'testID' FROM 'STU_RECORD' WHERE 'stuID' = '????????')";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    echo "Select the test that you want to appear for:";
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


</body>
</html>
