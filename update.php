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
  
		if (isset($_POST['mypost_submit']))
		{
			echo "inside";
			$msg=$_POST['mypost'];			
			$sql1="select profile_id from login where username='$user' and password='$pass'";
  
			$result = mysql_query($sql1,$conn);

			$row = mysql_fetch_assoc($result);

			$id = $row["profile_id"]; 

			echo "$msg";
			$sql2="insert into updatestatus (profile_id,msg,username,time) values('$id','$msg','$user',now())";
		
		if(mysql_query($sql2,$conn))
		{echo "updated";
		header("Location:profile.php");
		}
		else echo "not";
		}
	}

?>
						