<?php
	session_start();
	include_once 'dbconnect.php';

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
	<div id = "welcome-title">Welcome <?php echo $userRow['username']; ?> &nbsp;	</div>
	<div id = "top">
		<h2>Change Management</h2>
	</div>

	<div id = "user-frame-div">
		<div id = "user-menu-div">
			 <ul>
			  <li><a id = "odabran-show-request" href="showrequestsmanager.php">SHOW REQUESTS</a></li>
			  <li><a href="logout.php?logout">LOGOUT</a></li>
			</ul> 
		</div>

		<div id = "user-dashboard-div">
			
			<?php
				$veza = new PDO("mysql:dbname=bdchange;host=localhost;charset=utf8", "root", "root");
				$veza->exec("set names utf8");
				$rezultat = $veza->query("select id, username, email from users");

				foreach ($rezultat as $user) 
				{
					$ime = $user['username'];

					print("<div id = 'show-user-request'>".$ime."</div>");
				}
			?>
			<!--<div id = "show-user-request">
				testic
			</div>
			<div id = "show-user-request">
				testic
			</div>
			<div id = "show-user-request">
				testic
			</div>
			<div id = "show-user-request">
				testic
			</div>-->
		</div>
	</div>
</body>
</html>