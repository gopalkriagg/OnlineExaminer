<html>

<head>
    <title>
        Student Database
    </title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

</head>


<body>


<p>
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



$sql = "SELECT * FROM STU_RECORD where stuID='???????'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
     echo "<br> Test ID: ". $row["testID"]. "&nbsp|&nbsp Marks: ". $row["marks"];
    }
} else {
    echo "0 results";
}

?>
</p>



</body>
</html> 