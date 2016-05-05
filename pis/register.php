<?php 

	session_start();

	/*ima logovan korisnik*/
	if(isset($_SESSION['user']) != "")
	{
		$id = $_SESSION['user'];
		$res = mysql_query("SELECT * FROM users WHERE id='$id'");
		$row = mysql_fetch_array($res);
		
		  if($row['type'] == 0)
		  {
		  	header("Location: home.php");	
		  }
		  elseif ($row['type'] == 1) 
		  {
		  	header("Location: managerhome.php");
		  }
		  elseif ($row['type'] == 2) 
		  {
		  	header("Location: cabhome.php");
		  }

		/*header("Location : home.php");*/
	}
	include_once 'dbconnect.php';
	/*pressed Sign Up buttom*/
	if(isset($_POST['btn-signup']))
	{
		 $uname = mysql_real_escape_string($_POST['uname']);
		 $email = mysql_real_escape_string($_POST['email']);
		 $upass = md5(mysql_real_escape_string($_POST['pass']));
		 /*upisi mi ga u bazu hehe*/
		 if(mysql_query("INSERT INTO users(username,email,password) VALUES('$uname','$email','$upass')"))
		 {
		  ?>
		        <script>alert('Korisnik je uspjesno registrovan! Kul pravo!');</script>
		        <?php
	 }
	 else
	 {
		  ?>
		        <script>alert('Greska prilikom registracije korisnika :( ');</script>
		        <?php
	 }
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>CHANGE MANAGEMENT</title>
	<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
	<div id = "top">
		<h2>Change Management</h2>
	</div>
	<div id = "formFrameDiv" style="">
		<center>
			<div id="login-form">
				<form method="post">
					<table align="center" width="30%" border="0">
							<tr>
								<td><input type="text" name="uname" placeholder="User Name" required /></td>
							</tr>
							<tr>
								<td><input type="email" name="email" placeholder="Your Email" required /></td>
							</tr>
							<tr>
								<td><input type="password" name="pass" placeholder="Your Password" required /></td>
							</tr>
							<tr>
								<td><button type="submit" name="btn-signup">Sign Me Up</button></td>
								</tr>
							<tr>
								<td><a href="index.php">Sign In Here</a></td>
							</tr>
						</table>
				</form>
			</div>
		</center>
    </div>
</body>
</html>