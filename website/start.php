<?php
	session_start();
	if($_SESSION["sloggedin"] != TRUE) { //i.e. if student is not logged in
		header( 'Location: ./index.php' ) ; //One way to redirect
		die();
	}
	
	$quiz_id  =    $_SESSION['quiz'];
	$length   =  $_SESSION['length'];
	$time     =    $_SESSION['time'];

?>

<html>
  <head>
    <title>Quiz <?php echo mysql_real_escape_string($_GET['id']);?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
 
<body>

	<form method="post" name="quiz" id="quiz_form" action="finish_test.php" >

	<?php
	
		include 'database_connect.php';
		
		$sql_ques_contained = "SELECT * FROM QUES_CONTAINED WHERE testid = '$quiz_id' ;";//select only quesid
		
		$ques_contained = $conn->query($sql_ques_contained);
		
		$counter = 1; // Counter gives unique number (auto-incrment from 1) to each question
		
		$table_name = "$_SESSION[userid]$_SESSION[quiz]";
		$_SESSION["table_name"] = $table_name;

		$sql_create_table = "CREATE TABLE $table_name( 
							id int NOT NULL, 
							correct_ans char(1) NOT NULL, 
							counter int(3) NOT NULL, 
							ans_given char(1) DEFAULT 'E' NOT NULL);";
		$conn->query($sql_create_table); //if query fails student can't give test and is redirected to dashboard
		
		while($row = $ques_contained->fetch_assoc())  {
			$sql_question_fetch = "SELECT * FROM QUESTIONS WHERE  id = '$row[quesID]'";
			$question           = $conn->query($sql_question_fetch); 
			$ques_details       = $question->fetch_assoc();
	
			echo "$counter) "; //Prints question number
			
			echo $ques_details['descr']."<br>"; //Prints question description
			
			echo "<input type = 'radio'  checked=\"checked\" hidden name='$counter' value='E'>";
		
			echo "<input type = 'radio' name='$counter' value='A'>";
			echo $ques_details['choiceA']."<br>";
			
			echo "<input type = 'radio' name='$counter' value='B'>";
			echo $ques_details['choiceB']."<br>";
			
			echo "<input type = 'radio' name='$counter' value='C'>";
			echo $ques_details['choiceC']."<br>";
			
			echo "<input type = 'radio' name='$counter' value='D'>";
			echo $ques_details['choiceD']."<br>";
			
			$sql_insert = "INSERT INTO $table_name values($ques_details[id], '$ques_details[correctChoice]', $counter, 'E');";
			$conn->query($sql_insert);
		    
		    $counter++;
		}
	
	?>

	<input type="submit" value="Submit">  
	</form>


	<script type="text/javascript">
		var max_time      = <?php echo "$time" ?>;
		var c_seconds     = 0;
		var total_seconds = 60*max_time;
		max_time          = parseInt(total_seconds/60);
		c_seconds         = parseInt(total_seconds%60);
		document.getElementById("quiz-time-left").innerHTML='Time Left: ' + max_time + ' minutes ' + c_seconds + ' seconds';
		
		function init() {
			document.getElementById("quiz-time-left").innerHTML='Time Left: ' + max_time + ' minutes ' + c_seconds + ' seconds';
			setTimeout("CheckTime()",999);
		}
		
		function CheckTime(){
			document.getElementById("quiz-time-left").innerHTML='Time Left: ' + max_time + ' minutes ' + c_seconds + ' seconds' ;
			if(total_seconds <=0){
				setTimeout('document.quiz.submit()',1);
			}
			else {
			total_seconds = total_seconds -1;
			max_time = parseInt(total_seconds/60);
			c_seconds = parseInt(total_seconds%60);
			setTimeout("CheckTime()",999);
			}
		
		}
		
		init();
	</script>
	
	<script type="text/javascript">
		function finishpage() {
			alert("unload event detected!");
			document.quiz.submit();
		}
		window.onbeforeunload = function() {
			setTimeout('document.quiz.submit()',1);
		}
	</script>

</body>
</html>