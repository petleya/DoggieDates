<?php
  $u = $_GET['username'];
  $mysqli = new mysqli("FILL","FILL","FILL");
  if(!$mysqli || $mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
  }
  if(!($stmt = $mysqli->prepare("SELECT Mess1, Mess2, Mess3, sender1, sender2, sender3 FROM UserMessages WHERE Uname = ?"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
  }
  if(!($stmt->bind_param("s",$_GET['username']))){
    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
  }
  if(!$stmt->execute()){
    echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
  } 
  if(!$stmt->bind_result($M1, $M2, $M3, $sender1, $sender2, $sender3)){
    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
  }
   while($stmt->fetch())
  {
   $M1;
   $M2;
   $M3;
   $sender1;
   $sender2;
   $sender3;
  }
echo "Welcome ".$_GET['username']." !";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Customer Page</title>
<link href="customer.css" rel="stylesheet" type="text/css">
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
	    var Lat = 45.4961;
		var lng = -122.6149;
      function initialize() {
        var mapCanvas = document.getElementById('map-canvas');
		var myLatlng = new google.maps.LatLng(Lat, lng);
        var mapOptions = {
          center: myLatlng,
          zoom: 8,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(mapCanvas, mapOptions)
        var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
		icon: 'pets.png',
        title: 'Creston Park'
        })
		var marker = new google.maps.Marker({
        position: new google.maps.LatLng(45.5532, -122.6262),
        map: map,
		icon:'pets.png',
        title: 'Wilshire Park'
        })
		var marker = new google.maps.Marker({
        position: new google.maps.LatLng(45.4255, -122.7611),
        map: map,
		icon:'pets.png',
        title: 'Potso Dog Park'
        })
		var marker = new google.maps.Marker({
        position: new google.maps.LatLng(45.5526, -122.9098),
        map: map,
		icon:'pets.png',
        title: 'Hondo Park'
        })
		var marker = new google.maps.Marker({
        position: new google.maps.LatLng(45.5766, -122.3402),
        map: map,
		icon:'pets.png',
        title: 'Stevenson Dog Park'
        })

	  }
	  
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</head>

<body>
<h1 align = "center">Doggy Dates - Oregon</h1>
<h1 align = "center"><img src="grendel.jpg" width="96" height="128" alt=""/></h1>
<div id = "MessCenter">
  <h2> Messages </h2>
  <div id = "message"><?php
    echo "TO: ". $_GET['username'] ."<br>". $M1."<br>From: ". $sender1 . "<br>"; ?><br> </div>
  <div id = "message"><?php
    echo "TO: ". $_GET['username'] ."<br>". $M2."<br>From: " .$sender2."<br>"; ?> <br></div>
  <div id = "message"><?php
     echo "TO: ". $_GET['username'] ."<br>". $M3."<br>From: " .$sender3."<br>"; ?> <br></div>
</div>
<div id = "zip">
  <form action = "" method = "post">
    <p align="center"> Search for dogs by zip code: 
    <input type = "text" name = "zip">
    <input type = "submit" value = "search"></p>
  </form>

<?php
if($_POST && !empty($_POST['zip']) && $_POST['zip']>97921 || $_POST['zip']<97000){
  echo "<p align = 'center'>You Can only enter Oregon Zip Codes<p>";
}
if($_POST && !empty($_POST['zip']) && $_POST['zip'] < 97921 && $_POST['zip'] > 97000){
	echo"  <table>
	<tr>
	  <td>Dogs Ready To Play</td>
	</tr>
	  <tr>
	    <td>Dog's Name</td>
		<td>Breed</td>
	    <td>Size</td>
	    <td>Activity Level</td>
		<td>Contact</td>
	  </tr>";
  if(!($stmt = $mysqli->prepare("SELECT Dogs.name, Dogs.breed, Dogs.size, Dogs.activity, Users.Uname FROM Dogs INNER JOIN Users ON Users.Uname = Dogs.uname  Where Users.Zip = ?"))){
	echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
  }
  if(!($stmt->bind_param("i",$_POST['zip']))){
    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
  }
  if(!$stmt->execute()){
	echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
  }
  if(!$stmt->bind_result($dname, $breed, $size, $activity, $Uname)){
	echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
  }
  while($stmt->fetch()){
   echo "<tr>\n<td>\n" . $dname . "\n</td>\n<td>\n" . $breed. "\n</td>\n<td>\n" . $size . "\n</td>\n<td>\n". $activity . "\n</td>\n<td>\n" . $Uname . "\n</td>\n</tr>";
  }
echo "<button onclick='sendmess()'>Send a Message to a User</button>";
}

?>
<script>
var u = "<?php echo $u?>";
function sendmess(){
document.getElementById("toSend").innerHTML = "<textarea name='Message' form='send'>Enter Text here....</textarea><form id = 'send' action = 'sendmess.php' method='POST'>User to Send to: <input type = 'text' name = 'to'><input type = 'hidden' name = 'from' value = "+u+"><input type = 'submit' value = 'submit'></form>";
}
</script>
<?php
$stmt->close();
?>
      </table>
    <div id = "toSend"></div>
    </div>
    <div>    
    <div id = "resources">
      <h2>Good Resources for Dog Fun in Oregon</h2>
      <p><a href="http://www.bringfido.com/attraction/beaches/state/oregon/">Bring Fido Oregon Beaches</a><br>
        <a href="http://www.portlandpooch.com/index.htm">PorlandPooch.com</a>
      </p>
    </div>
    <div id="m">
    <h2>Map of Dog Parks</h2>
    <div id ="map-canvas"></div>
    </div>

</body>
</html>