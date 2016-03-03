<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$user =  $_POST['to'];
$mysqli = new mysqli("FILL","FILL","FILL","FILL");
if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
  if(!($stmt = $mysqli->prepare("SELECT Uname FROM Users WHERE Uname = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
  }
  if(!($stmt->bind_param("s",$_POST['to']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
  }
  if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
  }
  if(!$stmt->bind_result($Uname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
while($stmt->fetch()){
 $Uname;
}

if (empty($Uname)) {
  echo "Sorry you have entered a incorrect user name, please return to your page and re-enter the user name of the person you would like to contact</br>";
  $url = "customerpage.php?username=".urlencode($_POST['from']);
  echo "<a href=".$url.">Back to my page</a>";
}
else{
  if(!($stmt = $mysqli->prepare("SELECT Uname, Mess1, Mess2, sender1, sender2 FROM UserMessages WHERE Uname = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
  }
  if(!($stmt->bind_param("s",$_POST['to']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
  }
  if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
  }
  if(!$stmt->bind_result($Uname, $Mess1, $Mess2, $sender1, $sender2)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
  }
  while($stmt->fetch()){
    $Uname;
    $Mess1;
    $Mess2;
    $sender1;
    $sender2;
  }
  if(!($stmt = $mysqli->prepare("UPDATE  `petleya-db`.`UserMessages` SET  `Mess1` =  ?, `sender1` =  ? WHERE  `UserMessages`.`Uname` =?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
  }
  if(!($stmt->bind_param("sss",$_POST['Message'],$_POST['from'],$_POST['to']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
  }
  if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
  }
  if(!($stmt = $mysqli->prepare("UPDATE  `petleya-db`.`UserMessages` SET  `Mess2` =  ?, `sender2` =  ? WHERE  `UserMessages`.`Uname` =?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
  }
  if(!($stmt->bind_param("sss",$Mess1 ,$sender1,$_POST['to']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
  }
  if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
  }
  if(!($stmt = $mysqli->prepare("UPDATE  `petleya-db`.`UserMessages` SET  `Mess3` =  ?, `sender3` =  ? WHERE  `UserMessages`.`Uname` =?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
  }
  if(!($stmt->bind_param("sss",$Mess2 ,$sender2,$_POST['to']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
  }
  if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
  }
  else{
  echo "Your message Has been sent!<br>";
  $url = "customerpage.php?username=".urlencode($_POST['from']);
  echo "<a href=".$url.">Back to my page</a>";  
  }
}
?>
