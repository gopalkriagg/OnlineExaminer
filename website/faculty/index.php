<?php
	session_start();
	if($_SESSION["loggedin"] == TRUE) {
		header( 'Location: /franklin_website/stu_enroll.php' ) ; //One way to redirect
		die();
	}

?>

<!DOCTYPE html>
<html>
	
<head>
	<style>
		.error {color: #FF0000}
	</style>
    <title>
        Student login - Online Examiner
   	</title>
</head>
	
<body>
	<?php
		$useridErr = $pwdErr = $loginErr = "";
		$x = TRUE;
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			if(empty($_POST["userid"])) {
				$useridErr = "Username is required";
				$x = FALSE;
			}
			if(empty($_POST["pwd"])) {
				$pwdErr = "Password is required";
				$x = FALSE;
			}
			elseif(strlen($_POST["pwd"]) < 8) {
				$pwdErr = "Password must be 8 characters long.";
				$x = FALSE;
			}
		

			if($x == TRUE) {
				function encode($ipwd) { //ipwd is password to be encoded
					//algo to encode pwd
					//after encoding
					return $ipwd;
				}
				//connect to db, encode the wd and check it with db, if matches redirect to login page else
				//set loginErr"please enter again"
				$servername =      "localhost";
				$username   =           "root";
				$password   =          "mysql";
				$db         = "OnlineExaminer";
				$conn = new mysqli($servername, $username, $password, $db);
				if($conn->connect_error) {
				die("Connection to database failed: " . $conn->connect_error);
				}
				
				echo "<br>";
				$temp = $_POST["pwd"];
				$pwd = encode($temp);
				
				$sql = "SELECT * FROM STUDENTS WHERE id = '$_POST[userid]' AND pwd = '$pwd'";
				echo $sql;
				$result = $conn->query($sql);
				echo var_dump($result);
				if($result->num_rows == 1) {
					$row = $result->fetch_assoc();
					$_SESSION["username"] = $row["name"];
					$_SESSION["currentStatus"] = $row["currentStatus"];	
					$_SESSION["loggedin"] = TRUE;
					echo '<meta http-equiv="REFRESH" content="0" URL = "/franklin_website/stu_enroll.php">';
				} 
				else {
					$loginErr == "Wrong username or password.";
				}
	
			}
		}
	?>
	
	<form  method = "POST" action = "<?php echo $_SERVER["PHP_SELF"]; ?>" autocomplete = "off">
		<table width="600" border="0" align="center" cellpadding="5" cellspacing="5" >
			<tr>
    	    	<th colspan= "3"> Faculty Login </th>
			</tr>
    		<tr>
    			<td width = "78">User Id</td>
    			<td width = "6">:</td>
				<td width = "150"><input name = "userid" type = "text" id = "userid"  maxlength = "7"></td>
				<td width = "300"<span class = "error"> <?php echo $useridErr; ?> </span> </td>
    		</tr>
    		<tr>
    			<td>Password</td>
    			<td>:</td>
    			<td><input name = "pwd" type = "password" id = "password"  maxlength = "30"></td>
    			<td width = "300"<span class = "error"> <?php echo $pwdErr; ?> </span> </td>
    		</tr>
    		<tr>
    			<td colspan="3" align="center"><input type = "submit" name = "Submit" value = "Login">  </td>
		    </tr>
		    <tr>
		    	<td colspan="3"> <?php echo $loginErr; ?></td>
		    </tr>
    	</table>
   </form>
   
   <a  href=\"register_student.php\" > new Student? </a>
   
  </body>
  </html>


