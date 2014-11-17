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


$idTest=$_GET["idTest"];




$q_array = array();

$sql="SELECT quesID FROM QUES_CONTAINED WHERE testID = '$idTest'";
$len = $conn->query($sql);
$length = mysql_num_rows($len);

// query quiz table for all columns
$query_quiz = "SELECT quesID FROM QUES_CONTAINED WHERE testid = '$idTest' ";//select only quesid

$query_quiz_result = $conn->query($query_quiz);

while($row = $query_quiz_result->fetch_assoc()) {
      
      $question = "SELECT * FROM QUESTIONS WHERE  id = '$row["quesID"]";   
      $q_result = $conn->query($question);
        $row1 = $q_result->fetch_assoc());
        $q_array[] = $row1;

        

    }



session_start();
$_SESSION['quiz'] = $idTest;
$_SESSION['questions'] = $q_array;
$_SESSION['length'] = $length;
?>

<html>
  <head>
    <title>Quiz <?php echo mysql_real_escape_string($_GET['idTest']);?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div id="container" style="margin-left: 30px;">


<!-- create the header using the quiz id and name -->
<h1 style="text-align: center;">Quiz <?php echo $quiz['id'] ?>: <?php echo $quiz['name'] ?></h1>



<h4>This quiz will have a total of <?php echo $length?> questions.</h4>

<button onClick="parent.location='start.php'">Begin Quiz</button>

    </div>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>