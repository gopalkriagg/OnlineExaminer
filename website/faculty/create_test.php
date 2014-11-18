<?php
  session_start();
  if($_SESSION["floggedin"] != TRUE) { //i.e. if faculty is not logged in
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
?>

<html>
<head>
    <title>
        Create New test
    </title>
    
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>

<body>



<h2>Fill up details of the test</h2>

<form action="test_created.php" method="post">
 ID: <input type="text" name="id">
<br>
Test Duration: <input type="text" name="testtime">
<br>
Select the questions that you want in the test:

<br>
<?php

$ques_list = array();
$question = "SELECT * FROM QUESTIONS";   
$q_result = $conn->query($question);


     while($row1 = $q_result->fetch_assoc())
        {  

        
                    echo "<br><input type = 'checkbox'
            name='$ques_list' value='$row1[id]'>";
                    echo "".$row1['id'].".".$row1['descr']."<br>";
                    
            

        }




?>

<input type="submit" value="Submit">
</form>
</body>

</html>