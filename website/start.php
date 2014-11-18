<?php
	session_start();
	if($_SESSION["sloggedin"] != TRUE) { //i.e. if student is not logged in
		header( 'Location: ./index.php' ) ; //One way to redirect
		die();
	}

?>

<?php

	include 'database_connect.php'
	
	$quiz_id  = $_SESSION['quiz'];
	$length  = $_SESSION['length'];
	$time   = $_SESSION['time'];

?>

<html>
  <head>
    <title>Quiz <?php echo mysql_real_escape_string($_GET['id']);?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>

    <div id="container" style="margin-left: 30px;">

<form method="post" name="quiz" id="quiz_form" action="finish_test.php" >

<?php

$query_quiz = "SELECT * FROM QUES_CONTAINED WHERE testid = '$quiz_id' ";//select only quesid

$query_quiz_result = $conn->query($query_quiz);

$counter = 1;

while($row = $query_quiz_result->fetch_assoc()) 
{
      $question = "SELECT * FROM QUESTIONS WHERE  id = '$row[quesID]'";   
      $q_result = $conn->query($question);
       $row1 = $q_result->fetch_assoc();
         $q_counter= $row1['id'];
            echo "$counter) ";
            echo "".$row1['descr']."<br>";
               echo "<input type = 'radio' name='$counter' value='A'>";
               echo "".$row1['choiceA']."<br>";
               
               echo "<input type = 'radio'
            name='$counter' value='B'>";
                    echo "".$row1['choiceB']."<br>";
                    echo "<input type = 'radio'
            name='$counter' value='C'>";
                    echo "".$row1['choiceC']."<br>";
                    echo "<input type = 'radio'            
            name='$counter' value='D'>";
                    echo "".$row1['choiceD']."<br>";

            $counter++;

        


}

      


    


?>

<input type="submit" value="Submit">  
</form>







    </div>



<div style="font-weight: bold" id="quiz-time-left"></div>
<script type="text/javascript">
var max_time = <?php echo "$time" ?>;
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

<script type="text/javascript">

 function finishpage()
{
alert("unload event detected!");
document.quiz.submit();
}
window.onbeforeunload= function() {
setTimeout('document.quiz.submit()',1);
}
</script>

  </body>
</html>