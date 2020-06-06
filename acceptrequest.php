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
		$sendto_id=$_GET['sendtoid'];
		$fromid=$_GET['fromid'];
		//echo $fromid;

		/*on the request being accepted add the details to friend table and delete from the request table*/

		$insertFriend="insert into friend (profile_id1,profile_id2) values ('$sendto_id','$fromid')";
		if(mysql_query($insertFriend,$conn))
		{
			$deleteRequest="delete from request where profile_id='$fromid' and sent_to='$sendto_id'";
			mysql_query($deleteRequest,$conn);
			header("Location:profile.php");
		/* after deletion redirect to profile home page*/
		}
	}
	
?>