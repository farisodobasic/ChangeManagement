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

<?php


	/*pressed Sign Up buttom*/
	if(isset($_POST['btn-add']))
	{
		
		 
		 $title = mysql_real_escape_string($_POST['title']);
		 $benefits = mysql_real_escape_string($_POST['benefits']);
		 $reason = (mysql_real_escape_string($_POST['reason']));
		 $risks = (mysql_real_escape_string($_POST['risks']));
		 $priority = (mysql_real_escape_string($_POST['priority']));
		 $cons = (mysql_real_escape_string($_POST['cons']));
		 $budget = (mysql_real_escape_string($_POST['budget']));
		 $days = (mysql_real_escape_string($_POST['days']));

		 $usr_id = $_SESSION['user'];
		 $p = 0;

		 if($priority == 'low') $p = '0';
		 else if($priority == 'medium') $p = '1';
		 else if($priority == "high") $p = '2';
		 else $priority = '3';

		$con = new PDO("mysql:dbname=dbchange;host=localhost;charset=utf8", "admin", "admin");
			$con->exec("set names utf8");
	 
			 $res = $con->prepare("insert into `change` (user_id, prioritet, naslov, razlog, budzet, benefit, posljedice, rizik, vrijemeizvedbe, odobrenmanager, odobrencab) values (?,?,?,?,?,?,?,?,?,?,?)");
			 $res->execute(array($usr_id, $p, $title, $reason, $budget, $benefits, $cons, $risks, $days, 0, 0));
			 
			 
	 
	 
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
			  <li><a id = "odabran-show-request" href="addchange.php">ADD A NEW CHANGE REQUEST</a></li>
			  <li><a href="review.php">REVIEW MY CHANGE REQUESTS</a></li>
			  <li><a href="#">OPTION 1</a></li>
			  <li><a href="#">OPTION 2</a></li>
			  <li><a href="#">OPTION 3</a></li>
			  <li><a href="#">OPTION 4</a></li>
			  <li><a href="#">OPTION 5</a></li>
			  <li><a href="logout.php?logout">LOGOUT</a></li>
			</ul> 
		</div>

		<div id = "user-dashboard-div">
			
				<div id = "formFrameDiv" style="">
					<center>
						<div id="addChange-form">
							<form  method="post">
								<table id = "addform" align="center" width="80%" border="0">
									<tr>
										<td><input type="text" name="title" placeholder="Change title" required /></td>
										<td></td>
										<td><textarea name = "benefits" class="area" rows = "4" cols="20" placeholder="Change benefits" required></textarea></td>
									</tr>
									<tr>
										<td><textarea  name="reason" class="area" rows = "4" cols="20" placeholder="Reason for change" required></textarea></td>
										<td></td>
										<td><textarea name="risks" class="area" rows = "4" cols="20" placeholder="Change risks" required></textarea></td>
									</tr>

									<tr>
										<td> <select name="priority" class="area">
											  <option value="low">Low</option>
											  <option value="medium">Medium</option>
											  <option value="high">High</option>
											  <option value="very high">Very high</option>
											</select> </td>
											<td></td>
										<td><textarea name="cons" class="area" rows = "4" cols="20" placeholder="Change consequences" required></textarea></td>
									</tr>

									<tr>
										<td><input type="text" name="budget" placeholder="Change budget" required /></td>
										<td></td>
										<td><input type="text" name="days" placeholder="Number of days" required /></td>
									</tr>


									<tr>
										<td colspan="3"><button type="submit" name="btn-add" class="addchange">Add change</button></td>
									</tr>
									<tr>
										
									</tr>
								</table>
							</form>
						</div>
					</center>
    			</div>


		</div>
	</div>
</body>
</html>