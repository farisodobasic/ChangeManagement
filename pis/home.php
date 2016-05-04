<?php
	session_start();
	include_once 'dbconnect.php';
	?>
	<script>alert('Uspjesno ste logovani...treba to cesce ;) ');</script>
	<?php

	if(!isset($_SESSION['user']))
	{	
	 header("Location: index.php");
	}

	$res=mysql_query("SELECT * FROM users WHERE id=".$_SESSION['user']);
	$userRow=mysql_fetch_array($res);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>CHANGE MANAGEMENT</title>
	<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
	<div id = "welcome-title">Welcome <?php echo $userRow['username']; ?>&nbsp;</div>
	<div id = "top">
		<h2>Change Management</h2>
	</div>

	<div id = "user-frame-div">
		<div id = "user-menu-div">
			 <ul>
			  <li><a href="#">ADD A NEW CHANGE REQUEST</a></li>
			  <li><a href="#">REVIEW MY CHANGE REQUESTS</a></li>
			  <li><a href="#">DELETE CHANGE REQUESTS</a></li>
			  <li><a href="#">OPTION 1</a></li>
			  <li><a href="#">OPTION 2</a></li>
			  <li><a href="#">OPTION 3</a></li>
			  <li><a href="#">OPTION 4</a></li>
			  <li><a href="#">OPTION 5</a></li>
			  <li><a href="logout.php?logout">LOGOUT</a></li>
			</ul> 
		</div>

		<div id = "user-dashboard-div">
			meh2
		</div>
	</div>
</body>
</html>
