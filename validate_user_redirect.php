<?php
session_start();
$servername = "*****";
$username = "*****";
$password = "*****";
$dbname = "*****";

$conn = mysql_connect($servername, $username, $password);
$dbselect=mysql_select_db($dbname,$conn);



if (isset($_POST['login']))
{$user=$_POST['t4'];
$pass=$_POST['t5'];
echo $user;

$s="select username,password from login where username='$user' and password='$pass'";

	$result=mysql_query($s,$conn);

	$num=mysql_num_rows($result);
	echo $num;
	if($num==1)
	{
		$sql1="select username,password from login where username='$user' and password='$pass'";
		$result = mysql_query($sql1,$conn);
//$row = mysql_fetch_row($result);
$row = mysql_fetch_assoc($result);
$_SESSION['USER']=$row["username"];
$_SESSION['PASS']=$row["password"];
	//echo "successful";
	header("location:profile.php");
	}
	else
	{
	ob_start();
	
	echo '<script>alert("invalid details or please create an account");</script>';
	header("location:index.html");
	ob_end_flush();
	}
}



?>
