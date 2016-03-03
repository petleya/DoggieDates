<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("FILL");
if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
$Mess1 = "Hello welcome to Doggy Dates";
$Mess2="This is a place where dog owners can seek out other dogs that would like to be social and play in there area or areas near by";
$Mess3="Enter a zip code below to find dogs in that area since this is a new sites we don't have dogs in all areas meet my dog Grendel in zip code 97420";
$sender1 = "DoggyDates";
$sender2 = "DoggyDates";
$sender3 = "DoggyDates";	
if(!($stmt = $mysqli->prepare("INSERT INTO Dogs(name, breed, size, activity, uname) VALUES (?,?,?,?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("sssss",$_POST['dname'],$_POST['breed'],$_POST['size'],$_POST['level'], $_POST['uname']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} 
	
if(!($stmt = $mysqli->prepare("INSERT INTO Users(Uname, password, Zip) VALUES (?,?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("ssi",$_POST['uname'],$_POST['pass'],$_POST['zip']))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt = $mysqli->prepare("INSERT INTO UserMessages(Uname, Mess1, Mess2, Mess3, sender1, sender2, sender3) VALUES (?,?,?,?,?,?,?)"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param("sssssss",$_POST['uname'],$Mess1, $Mess2, $Mess3, $sender1, $sender2, $sender3))){
	echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
	echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
}
$stmt->close();
header("Location:finalP.php");
?>