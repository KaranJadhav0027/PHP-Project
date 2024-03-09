<?php
require('con_pg.php');
session_start();
if(isset($_POST['u_name']))
{
 $u_name=stripslashes($_REQUEST['u_name']);
 $u_name=pg_escape_string($con,$u_name);
 $u_pass=stripslashes($_REQUEST['u_pass']);
 $u_pass=pg_escape_string($con,$u_pass);
 $query="SELECT * FROM users WHERE u_name='$u_name' and u_pass='$u_pass'";
 $result=pg_query($con,$query)or die(pg_last_error());
 $rows=pg_num_rows($result);
 if($rows==1)
 {
  
  $_SESSION['u_name']=$u_name;
  header("Location:dairy_product.php");
 }
 else
 {
  echo "<div class='form'>
  <h3>username/password is incorrect</h3>
  <br>Click here to <a href='index.php'>Login</a></div>";
 }
}
else
 {
	 ?>
<!DOCTYPE html>
<html>
<head>
<link style="text/css" rel="stylesheet" href="Style.css"/>
<link style="text/css" rel="stylesheet" href="style2.css"/>
<meta charset="utf-8">
</head>
<body>
<ul>
<li><a >Home</a></li>
<li><a href="dairy_product.php">Dairy Products</a></li>
<li><a>Profile</a></li>

</ul>
<div class="box1">
<div class="h1"><h1>Online<br>Milk/Dairy Products</h1></div>
<div class="p"><P>Don't Have Account?</p></div>
<div class="p"><p><a href="registration.php"><input type="submit" name="register" value="register" /></a></p></div>
</div>
<div class="box2">
<div class="logintxt">
<h1>Login</h1></div>
    
<form action=" " method="POST" name="login">
User Name&nbsp: <input type="text" name="u_name" placeholder="username" required/><br><br>
&nbsp Password &nbsp: <input type="password" name="u_pass" placeholder="p1assword" required/><br><br>
<input type="submit" name="submit" value="login">
</form>
</div>
<div class="footer"> About Us </div>
 <?php } ?>
</body>
</html>
      