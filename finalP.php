<?php session_start();
ini_set('display_errors', 'On');
//Connects to the database

if(isset($_POST['end'])){
    session_destroy();
}
if($_POST && !empty($_POST['username']) && !empty($_POST['pword'])){
  $mysqli = new mysqli("FILL","FILL","FILL");
  if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
  }
  if(!($stmt = $mysqli->prepare("SELECT password FROM Users WHERE Uname = ?"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
  }
  if(!($stmt->bind_param("s",$_POST['username']))){
    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
  }
  if(!$stmt->execute()){
    echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
  } 
  if(!$stmt->bind_result($pwd)){
    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
  };
  while($stmt->fetch())
  {
	  if($pwd == $_POST['pword']){
	    header("Location:customerpage.php?username=".urlencode($_POST['username']));
	  }
	  else{
	    echo "you have entered and incorrect password";
	  }
  }
  $stmt->close();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Final Project</title>
<link href="finalStyle.css" rel="stylesheet" type="text/css">
</head>
<body>
<h1 align = "center">Doggy Dates</h1>
<div>

    <form action="finalP.php" method="POST">
      <p align = "center" >Username: <input type="text" name="username"/></p>
      <p align = "center">Password: <input type="password" name = "pword"/></p>
      <p align = "center"><input type="submit" value= "Login"/></p>
      <p align= "center"><a href="Dog.php">New User's Register Here</a></p>
    </form>

</div>
</body>
</html>
