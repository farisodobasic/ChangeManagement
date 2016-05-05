<?php
session_start();

if(!isset($_SESSION['user']))
{
 header("Location: index.php");
}
else if(isset($_SESSION['user'])!="")
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

/* header("Location: home.php");*/
}

if(isset($_GET['logout']))
{
 session_destroy();
 unset($_SESSION['user']);
 header("Location: index.php");
}
?>