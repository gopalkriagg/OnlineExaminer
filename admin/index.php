<!DOCTYPE html>
<html>
<head>
	<title>
		Faculty login
	</title>
</head>
<body>

<?php

if (!$_POST) {

	$filename=$_SERVER["PHP_SELF"]; 

	echo "
	
	<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"1\" bgcolor=\"#CCCCCC\">
	<tr>
	<form name=\"form1\" method=\"post\" action=\"check_login.php\">
	<td>
	<table width=\"100%\" border=\"0\" cellpadding=\"3\" cellspacing=\"1\" bgcolor=\"#FFFFFF\">
	<tr>
	<td colspan=\"3\"><strong>Faculty Login </strong></td>
	</tr>
	<tr>
	<td width=\"78\">User Id</td>
	<td width=\"6\">:</td>
	<td width=\"294\"><input name=\"myusername\" type=\"text\" id=\"myusername\"></td>
	</tr>
	<tr>
	<td>Password</td>
	<td>:</td>
	<td><input name=\"mypassword\" type=\"password\" id=\"mypassword\"></td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td><input type=\"submit\" name=\"Submit\" value=\"Login\"></td>
	</tr>
	</table>
	</td>
	</form>
	</tr>
	</table>

	<a  href=\"register_faculty.php\" > new Faculty? </a>


	";

     

} 
else 

{
	echo "
	
	<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"1\" bgcolor=\"#CCCCCC\">
	<tr>
	<form name=\"form1\" method=\"post\" action=\"$filename\">
	<td>
	<table width=\"100%\" border=\"0\" cellpadding=\"3\" cellspacing=\"1\" bgcolor=\"#FFFFFF\">
	<tr>
	<td colspan=\"3\"><strong>Faculty Login </strong></td>
	</tr>
	<tr>
	<td width=\"78\">User Id</td>
	<td width=\"6\">:</td>
	<td width=\"294\"><input name=\"myusername\" type=\"text\" id=\"myusername\"></td>
	</tr>
	<tr>
	<td>Password</td>
	<td>:</td>
	<td><input name=\"mypassword\" type=\"password\" id=\"mypassword\"></td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td><input type=\"submit\" name=\"Submit\" value=\"Login\"></td>
	</tr>
	</table>
	</td>
	</form>
	</tr>
	</table>

	<a  href=\"register_faculty.php\" > new Faculty? </a>
	Wrong Username and Password.
 
	";
}
?>


</body>
</html>