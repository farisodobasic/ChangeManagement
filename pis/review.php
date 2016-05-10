<?php
	session_start();
	include_once 'dbconnect.php';


	if(!isset($_SESSION['user']))
	{	
	 header("Location: index.php");
	}

	$res=mysql_query("SELECT * FROM users WHERE id=".$_SESSION['user']);
	$userRow=mysql_fetch_array($res);

	if(isset($_POST['btn-delete']))
	{
		$changeid = $_POST['changeid'];
		$veza = new PDO("mysql:dbname=dbchange;host=localhost;charset=utf8", "admin", "admin");
		$veza->exec("set names utf8");
		$sql = "DELETE FROM `change` WHERE id = :change_id";
		$stmt = $veza->prepare($sql);
		$stmt->bindParam('change_id', $changeid, PDO::PARAM_INT);
		$stmt->execute();

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
	<div id = "welcome-title">Welcome <?php echo $userRow['username']; ?>&nbsp;	</div>
	<div id = "top">
		<h2>Change Management</h2>
	</div>

	<div id = "user-frame-div">
		<div id = "user-menu-div">
			 <ul>
			  <li><a href="addchange.php">ADD A NEW CHANGE REQUEST</a></li>
			  <li><a id = "odabran-show-request" href="review.php">REVIEW MY CHANGE REQUESTS</a></li>
			  <li><a href="#">OPTION 1</a></li>
			  <li><a href="#">OPTION 2</a></li>
			  <li><a href="#">OPTION 3</a></li>
			  <li><a href="#">OPTION 4</a></li>
			  <li><a href="#">OPTION 5</a></li>
			  <li><a href="logout.php?logout">LOGOUT</a></li>
			</ul> 
		</div>

		<div id = "user-dashboard-div">
			<?php
			
				
				$veza = new PDO("mysql:dbname=dbchange;host=localhost;charset=utf8", "admin", "admin");
				$veza->exec("set names utf8");

						$id = $_SESSION['user'];
						/*SELEKTOVANJE CHANGE-ova SVIH USERA*/
						
						$result = $veza->query("SELECT id, naslov, UNIX_TIMESTAMP(datum) vrijeme, odobrenmanager, odobrencab FROM `change` where user_id ='".$id."'");
						foreach ($result as $changer) 
						{
							$naslov = $changer['naslov'];
							$datum = date("h:m:Y (h:i)", $changer['vrijeme']);
							$changeid = $changer['id'];
							$odobrioManager = $changer['odobrenmanager'];
							$odobrioCab = $changer['odobrencab'];
							$status = "Not approved";
							if($odobrioCab == 1) $status = "Approved";

							$changeid = $changer['id'];
							
								print "<div id = 'show-user-changes'>";
										print "Title : " .$naslov;
										print "<br><br>";
										print "Creation date : " .$datum;
										print "<br><br>";
										print "Status : " . $status;
										print "<br><br>";
										print "<form method = 'post' id = 'accept-change'>
																<table>
																	<tr>
																		<td><button type='submit' name='btn-delete' id = 'button-accept'>Delete</button></td>
																		<td><input type='text' value='".$changeid."' name='changeid' style='display:none;'></button></td>
																	</tr>
																</table>
															</form>";
										print "</div>";
										
						}
										
				
			?>
		</div>
	</div>
</body>
</html>