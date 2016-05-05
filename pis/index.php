<?php
	session_start();
	include_once 'dbconnect.php';

	if(isset($_SESSION['user'])!="")
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


	 	/*header("Location: home.php");*/
	}
	if(isset($_POST['email']))
	{
		 $email = mysql_real_escape_string($_POST['email']);
		 $upass = mysql_real_escape_string($_POST['pass']);
		 $res=mysql_query("SELECT * FROM users WHERE email='$email'");
		 $row=mysql_fetch_array($res);

		 if($row['password']==md5(mysql_real_escape_string($upass)))
		 {
			  $_SESSION['user'] = $row['id'];
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

			  
		 }
		 else
		 {
	  			?>
		        <script>alert('wrong details');</script>
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
							<td><input type="text" name="email" placeholder="Your Email" required /></td>
						</tr>
						<tr>
							<td><input type="password" name="pass" placeholder="Your Password" required /></td>
						</tr>
						<tr>
							<td><button type="submit" name="btn-login">Sign In</button></td>
						</tr>
						<tr>
							<td><a href="register.php">Sign Up Here</a></td>
						</tr>
					</table>
				</form>
			</div>
		</center>
    </div>
</body>
</html>