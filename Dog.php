<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Final Project</title>
<link href="addDogStyle.css" rel="stylesheet" type="text/css">
</head>
<body>
<h1 align = "center">Doggy Dates</h1>
    <form action="addDog.php" method="POST">
      <p>Zip Code: <input type="text" name = "zip"/></p>
      <p>Dog's name: <input type="text" name="dname"/></p>
      <p>Dog's size:<select name="size">
        <option value="small">Small</option>
        <option value="medium">Medium</option>
        <option value ="large">Large</option>
      </select></p>
      <p>Dog's activity level:<select name="level">
        <option value="low">Low</option>
        <option value="medium">Medium</option>
        <option value ="high">High</option>
      </select></p>
      <p>Breed: <input type = "text" name = "breed"/></p>
      <p>Choose a User Name : <input type="text" name="uname"/></p>
      <p>Choose a password: <input type="password" name = "pass"/></p>
      <p><input type="submit" value= "Sign up"/></p> 
    </form>
</body>
</html>