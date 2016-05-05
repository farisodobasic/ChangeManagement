<?php
	session_start();
	include_once 'dbconnect.php';

	if(!isset($_SESSION['user']))
	{	
	 header("Location: index.php");
	}
	$res=mysql_query("SELECT * FROM users WHERE id=".$_SESSION['user']);
	$userRow=mysql_fetch_array($res);

	if(isset($_POST['btn-accept']))
	{
		$changeis = $_POST['userchangeid'];
		/*echo $ime;*/
		
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
				$veza = new PDO("mysql:dbname=dbchange;host=localhost;charset=utf8", "admin", "admin");
				$veza->exec("set names utf8");
				$rezultat = $veza->query("select id, username, email, type from users");

				foreach ($rezultat as $user) 
				{
					if($user['type'] == 0)
					{
						$ime = $user['username'];
						$id = $user['id'];
						/*SELEKTOVANJE CHANGE-ova SVIH USERA*/
						/*print("<div id = 'show-user-request'>".$ime."</div>");*/
						$result = $veza->query("SELECT id, naslov, UNIX_TIMESTAMP(datum) vrijeme FROM `change` where user_id = '$id'");
						print "<div id = 'show-user-request'>
									<div id = 'naslov-ime-usera'>
										".$ime."
									</div>";
									foreach ($result as $changer) 
									{
										$naslov = $changer['naslov'];
										$datum = date("h:m:Y (h:i)", $changer['vrijeme']);
										$changeid = $changer['id'];
										
										print "<div id = 'show-user-changes'>";
													print $naslov;
													print "<br><br>";
													print $datum;
													print "<form method = 'post'>
														<table align='center'>
															<tr>
																<td><button type='submit' name='btn-accept'>Accept</button></td>
																<td><input type='text' value='".$changeid."' name='userchangeid' style='display:none;'></button></td>
															</tr>
														</table>
													</form>
												</div>";
									}
										
						print"</div>";
					}
				}
			?>
			<!--<div id = "show-user-request">
				<div id = "naslov-ime-usera">
					Faris
				</div>
				<div id = "show-user-changes">
					Naslov<br><br>
					Datum
					<form method = "post">
						<table align="center">
							<tr>
								<td><button type="submit" name="btn-accept">Accept</button></td>
								<td><input type="text" value="faris" name="txt" style="display:none;"></button></td>
							</tr>
						</table>
					</form>
				</div>
			</div>-->

			<!--<div id = "show-user-request">
				<div id = "naslov-ime-usera">
					Orhan
				</div>

				<div id = "show-user-changes">
					<div id = "user-change-manager">
						Naslov<br><br>
						Datum
						<form method = "post">
							<table align="center">
								<tr>
									<td><button type="submit" name="btn-accept">Accept</button></td>
									<td><input type="text" value="orhan" name="userchangeid" style="display:none;"></button></td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>

			<div id = "show-user-request">
				<div id = "naslov-ime-usera">
					Orhan
				</div>

				<div id = "show-user-changes">
					<div id = "user-change-manager">
						Naslov<br><br>
						Datum
						<form method = "post">
							<table align="center">
								<tr>
									<td><button type="submit" name="btn-accept">Accept</button></td>
									<td><input type="text" value="faris" name="userchangeid" style="display:none;"></button></td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>-->


		</div>
	</div>
</body>
</html>