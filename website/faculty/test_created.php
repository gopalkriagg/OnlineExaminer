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

 <?php

 $fac_id= $_SESSION["userid"];
 $id= $_POST["id"];
 $testtime= $_POST["testtime"];
//$_POST['ques_list']
$flag=0;
$N=0;
$i=0;
$ques = $_POST['ques_list'];



 if(empty($ques)) 
  {
    echo("You didn't select any questions. <br>");
   $flag=0;
   }

  else
  {
    $N = count($ques);
 
    echo("You selected $N questions(s) for the test $id: <br> ");
  }

  for($i=0; $i < $N; $i++)
    {
      $sql1 = "INSERT INTO QUES_CONTAINED (testID, quesID) VALUES ('$id','$ques[$i]')";
       
       if ($conn->query($sql1) === TRUE) {
          $flag=1;
          echo($ques[$i] . " ");
          } 
        else{
          $flag=0;

          }
      
    }

$sql = "INSERT INTO TESTS (id, given, setBy, time) VALUES ('$id', 'N', '$fac_id','$testtime')";

if ($flag==1) {
  
      if ($conn->query($sql) === TRUE) {
          $flag=1;
      }else{
        $flag=0;
      } 

}



if ($flag == 1) {
    echo "New Test successfully";
} else {
 echo "Test creation failed. try again.";
}


?>

</body>

</html>