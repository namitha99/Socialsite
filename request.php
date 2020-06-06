<?php
session_start();
$servername = "*****";
$username = "*****";
$password = "*****";
$dbname = "*****";
$conn = mysql_connect($servername, $username, $password);
$dbselect=mysql_select_db($dbname,$conn);
if($conn)
{
	if($dbselect)
	{
		if(isset($_SESSION['USER']))
			$user=$_SESSION['USER'];
		
   		if(isset($_SESSION['PASS']))
  			$pass=$_SESSION['PASS'];
		$fromid=$_GET['fromid'];
		//echo $fromid;
		$sendto_id=$_GET['sendtoid'];
		
		$insertReq="insert into request (profile_id,sent_to) values ('$fromid','$sendto_id')";
		if(mysql_query($insertReq,$conn))
		{ 
			header("Location:profile.php");
		}
	}
}

?>