<?php
session_start();
$servername = "*****";
$username = "*****";
$password = "*****";
$dbname = "*****";
$user=$_POST['t1'];
$pass=$_POST['t2'];
$email=$_POST['t3'];

// Create connection
$conn = mysql_connect($servername, $username, $password);
$dbselect=mysql_select_db($dbname,$conn);
// Check connection

if($conn)
{

  if($dbselect)
	{	/*check for the uniqueness of the username if no user name exists for the given username user profile created else echo username already exists*/
		$find="select * from login where username='$user'";
		if(mysql_query($find,$conn))
			
		{	$find_res=mysql_query($find,$conn);
			$num=mysql_num_rows($find_res);
		}
		if($num==0)
		{
		$sql="insert into login (username,password,email) values('$user','$pass','$email')";
 
		if(mysql_query($sql,$conn))
		{ 	//echo "created";
			$_SESSION['USER']=$user;
			$_SESSION['PASS']=$pass;
	
			header("Location:profile.php");
		}
		else
			echo "not created";
		}
		else
			?>
		<html>
		<body>
		<h1>
		<?php
			echo "username already exists";?>
			</body>
			</html>
			<?php
	}
	else
		echo "not selected";
	
}
 else
	echo "not connected";

?>

