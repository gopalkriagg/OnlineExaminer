<?php
	session_start();
	if($_SESSION["floggedin"] != TRUE) { //i.e. if faculty is not logged in
		header( 'Location: ./index.php' ) ; //One way to redirect
		die();
	}

?>
<html>
	
<head>
	<title>
		Add question - OnlineExaminer
	</title>
	<style>
		.error {color: #FF0000}
	</style>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>

<body>
	<?php
		$descErr = $chaErr = $chbErr = $chcErr = $chdErr = $ansErr = $diffErr = "";
		$x = TRUE;
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			if(empty($_POST["desc"])) {
				$descErr = "Question description is required";
				$x = FALSE;
			}
			if(empty($_POST["cha"])) {
				$chaErr = "Choice A is required";
				$x = FALSE;
			}
			if(empty($_POST["chb"])) {
				$chbErr = "Choice B is required";
				$x = FALSE;
			}
			if(empty($_POST["chc"])) {
				$chcErr = "Choice C is required";
				$x = FALSE;
			}
			if(empty($_POST["chd"])) {
				$chdErr = "Choice D is required";
				$x = FALSE;
			}
			if($_POST["ans"] == "X") {
				$ansErr = "Correct answer must be specified";
				$x = FALSE;
			}
			if($_POST["diff"] == "0") {
				$diffErr = "Difficulty level must be specified";
				$x = FALSE;
			}
			
			if($x) {
				include '../database_connect.php';
				
				$sql = "INSERT INTO QUESTIONS(descr, choiceA, choiceB, choiceC, choiceD, correctChoice, difficultyLevel, setBy) ";
				$sql = $sql."values('$_POST[desc]', '$_POST[cha]', '$_POST[chb]', '$_POST[chc]', '$_POST[chd]', '$_POST[ans]', $_POST[diff], '$_SESSION[userid]');";
				//echo $sql;
				if($conn->query($sql) == TRUE)
					echo "<h3>Question added succesfuly</h3>";
				else
				echo "Error adding the question. " . $conn->error;
				
				$conn->close();	
			}
		}
	?>
	<div align="right">
		Welcome <?php echo $_SESSION["username"]; ?>!
		&nbsp;&nbsp;&nbsp;
		<a href="./index.php"> Dashboard</a>
		&nbsp;&nbsp;&nbsp;
		<a href="./logout.php"> Log Out </a>
	</div> 
	<hr>
	<form method = "POST" action="<?php echo $_SERVER["PHP_SELF"]?>" automcomplete = "off">
		<table width="850" align="left" border="0" cellpadding="5" cellspacing="0" >
			<tr>
				<td width="100">*Enter Question</td>
				<td><textarea maxlength="500" name="desc" rows="10" cols="60" ></textarea></td>
				<td><span class="error"><?php echo $descErr; ?></span></td>
			</tr>
			<tr>
				<td width="100">*Choice A</td>
				<td><textarea maxlength="100" name="cha" rows="3" cols="60" ></textarea></td>
				<td><span class="error"><?php echo $chaErr; ?></span></td>
			</tr>
			<tr>
				<td width="100">*Choice B</td>
				<td><textarea maxlength="100" name="chb" rows="3" cols="60" ></textarea></td>
				<td><span class="error"><?php echo $chbErr; ?></span></td>
			</tr>
			<tr>
				<td width="100">*Choice C</td>
				<td><textarea maxlength="100" name="chc" rows="3" cols="60" ></textarea></td>
				<td><span class="error"><?php echo $chcErr; ?></span></td>
			</tr>
			<tr>
				<td width="100">*Choice D</td>
				<td><textarea maxlength="100" name="chd" rows="3" cols="60" ></textarea></td>
				<td><span class="error"><?php echo $chdErr; ?></span></td>
			</tr>
			<tr>
				<td>*Correct answer</td>
				<td><select id="ans" name="ans" >
					<option selected  hidden value="X">Select</option>
					<option value="A">Choice A</option>
					<option value="B">Choice B</option>
					<option value="C">Choice C</option>
					<option value="D">Choice D</option>
					</select>
				</td>
				<td><span class="error"><?php echo $ansErr; ?></span></td>
			</tr>
			<tr>
				<td>*Difficulty</td>
				<td><select id="diff" name="diff" >
					<option selected  hidden value="0">Select</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					</select>
					5 represents most difficult
				</td>
				<td><span class="error"><?php echo $diffErr; ?></span></td>
			</tr>
			<tr>
				<td><input type="submit" value="Submit" name="submit"/></td>
			</tr>
			<tr>
				<td colspan="2">* represents required field</td>
			</tr>
		</table>
	</form>
</body>