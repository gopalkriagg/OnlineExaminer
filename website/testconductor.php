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
        Student Database
    </title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

</head>


<body>


<?


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


$idTest=$_GET["idTest"];

$sql = "SELECT * FROM 'TESTS' WHERE id = '$idTest')";
$result = $conn->query($sql);
$row = $result->fetch_assoc();


$sql = "SELECT * FROM 'QUES_CONTAINED' WHERE testID = '$idTest')";
$result = $conn->query($sql);
$row = $result->fetch_assoc();






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

 


<div style="font-weight: bold" id="quiz-time-left"></div>
<script type="text/javascript">
var max_time = <?php echo $row_2['num_timer'] ?>;
var c_seconds  = 0;
var total_seconds =60*max_time;
max_time = parseInt(total_seconds/60);
c_seconds = parseInt(total_seconds%60);
document.getElementById("quiz-time-left").innerHTML='Time Left: ' + max_time + ' minutes ' + c_seconds + ' seconds';
function init(){
document.getElementById("quiz-time-left").innerHTML='Time Left: ' + max_time + ' minutes ' + c_seconds + ' seconds';
setTimeout("CheckTime()",999);
}
function CheckTime(){
document.getElementById("quiz-time-left").innerHTML='Time Left: ' + max_time + ' minutes ' + c_seconds + ' seconds' ;
if(total_seconds <=0){
setTimeout('document.quiz.submit()',1);
    
    } else
    {
total_seconds = total_seconds -1;
max_time = parseInt(total_seconds/60);
c_seconds = parseInt(total_seconds%60);
setTimeout("CheckTime()",999);
}

}
init();
</script>



<?









?>
</p>



</body>
</html> 