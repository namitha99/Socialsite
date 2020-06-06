<?php
session_start();
$servername = "*****";
$username = "*****";
$password = "*****";
$dbname = "*****";

$conn = mysql_connect($servername, $username, $password);
$dbselect=mysql_select_db($dbname,$conn);

if($conn)

//echo "  CONNECTION ESTABLISHED \r\n";

  if($dbselect)
	
	{  
		if(isset($_SESSION['USER']))
			$user=$_SESSION['USER'];
  
  
		if(isset($_SESSION['PASS']))
  			$pass=$_SESSION['PASS'];
		$fromid=$_GET['sendtoid'];
		$sendto_id=$_GET['fromid'];
		
			$deleteRequest="delete from request where profile_id='$fromid' and sent_to='$sendto_id'";
			mysql_query($deleteRequest,$conn);
			header("Location:profile.php");
		
	}
	
?>