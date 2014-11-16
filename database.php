<<!DOCTYPE html>
<html>
<head>
	<title>
		Database
	</title>
</head>
<body>

<?php

$servername = "localhost";
$username = "root";
$password = "sqlpass";
$db="online";

// Create connection
$cn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else
(echo "string";)




?>

</body>
</html>