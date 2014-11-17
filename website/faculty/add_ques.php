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
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>

<body>
	<?php
		$descErr = $chaErr = $chbErr = $chcErr = $chdErr = $ansErr = $diffErr = "";
		$x = TRUE;
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			if(empty($_POST["desc"])) {
				$useridErr = "Question description is required";
				$x = FALSE;
			}
			if(empty($_POST["cha"])) {
				$pwdErr = "Choice A is required";
				$x = FALSE;
			}
			if(empty($_POST["chb"])) {
				$pwdErr = "Choice B is required";
				$x = FALSE;
			}
			if(empty($_POST["chc"])) {
				$pwdErr = "Choice B is required";
				$x = FALSE;
			}
			if(empty($_POST["chd"])) {
				$pwdErr = "Choice B is required";
				$x = FALSE;
			}
			if(empty($_POST["ans"])) {
				$pwdErr = "Correct answer must be specified";
				$x = FALSE;
			}
			if(empty($_POST["diff"])) {
				$pwdErr = "Difficulty level must be specified";
				$x = FALSE;
			}
		}
	?>
	<div align="right"> Welcome <?php echo $_SESSION["username"]; ?>! &nbsp;&nbsp;&nbsp;<a href="./logout.php"> Log Out </a></div> 
	<hr>
	<form method = "POST" action="<?php echo $_SERVER["PHP_SELF"]?>" automcomplete = "off">
		<table width="650" align="left" border="0" cellpadding="5" cellspacing="0" >
			<tr>
				<td width="100">*Enter Question</td>
				<td><textarea maxlength="500" name="desc" rows="10" cols="60" ></textarea></td>
			</tr>
			<tr>
				<td width="100">*Choice A</td>
				<td><textarea maxlength="100" name="cha" rows="3" cols="60" ></textarea></td>
			</tr>
			<tr>
				<td width="100">*Choice B</td>
				<td><textarea maxlength="100" name="chb" rows="3" cols="60" ></textarea></td>
			</tr>
			<tr>
				<td width="100">Choice C</td>
				<td><textarea maxlength="100" name="chb" rows="3" cols="60" ></textarea></td>
			</tr>
			<tr>
				<td width="100">Choice D</td>
				<td><textarea maxlength="100" name="chb" rows="3" cols="60" ></textarea></td>
			</tr>
			<tr>
				<td>*Correct answer</td>
				<td><select id="ans" name="ans" >
					<option value="A">Choice A</option>
					<option value="B">Choice B</option>
					<option value="C">Choice C</option>
					<option value="D">Choice D</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>*Difficulty</td>
				<td><select id="diff" name="diff" >
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><input type="submit" value="Submit" name="submit"/></td>
			</tr>
			<tr>
				<td colspan="2">* represents required question</td>
			</tr>
		</table>
	</form>
</body>