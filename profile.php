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
		else
		{
			echo "session expired";
			header("Location:start.html");
		}
   		if(isset($_SESSION['PASS']))
  			$pass=$_SESSION['PASS'];
		$sql1="select profile_id from login where username='$user' and password='$pass'";  
		$result = mysql_query($sql1,$conn);
		$row = mysql_fetch_assoc($result);
		$id = $row["profile_id"];
		
		$selectPost="select msg,username,time
		from updatestatus
		where profile_id in ((select profile_id1
							from friend
							where profile_id2='$id'
							union
							select profile_id2
							from friend
							where profile_id1='$id'
							)
							)
		order by time desc
		limit 0,20";
		
		$result = mysql_query($selectPost,$conn);
  
		
	}

?>

<html>
<head>
<title>PROFILE PAGE</title>

</head>
<style>
#home1
{
background: RGBA(7,40,0,1);
//background: RGBA(195,100,90,0.5);
	//width:500px;
position:relative;
//left:400px;
margin-top:10px;
//z-index:-1;
}
#button {
						  border: none;
						  outline: 0;
						  display: inline-block;
						  padding: 8px;
						  color: black;
						  //background-color: #000;
						  text-align: center;
						  cursor: pointer;
						  width: 90%;
						  //height:59px;
						  font-weight:bold;
						   border-radius: 90px;
						  font-size: 18px;
						}
	


</style>

<body>


<h1>
<?php
echo $user;?></h1>
<div id="home1" align="right">	
  
		
	<form method="post">
	<table width=20%>
		<tr>
			<td>
			<input type="submit" name="friend" value="friend" formaction="friend.php" id="button">
			</td>
			
		
			<td>		
			<input type="submit" name="logout" value="logout" onclick="logout()" formaction="logout.php" id="button">
			</td>

						
		</tr>	
				
	</table>
	</form>
</div>
<div align="left">
<form method="post">
  <textarea name="mypost" rows="10"  cols="50"></textarea>
  <br><br>
  <input type="submit" name="mypost_submit" formaction="update.php">
</form>

</div>
<?php
if(mysql_query($selectPost,$conn))
{	$selectPost_res=mysql_query($selectPost,$conn);
$num=mysql_num_rows($selectPost_res);
if($num>0)
	while($row= mysql_fetch_array($result)) 

	{
?>		
		<div id="bor" align="center">
			<div class="card">
				<form>
					<table width="800">
					
					<tr style="background-color:#FF0000">
						
						<td style="width:50%">
						
						
						 
						 <b>
						 <font size="5" color="black" face="arial">
						 <?php 
						 echo $row['username']; 
						 ?>
						 </font>
						 </td>
						 
						 <td style="width:50%">
						<b> <?php
						 echo $row['time']; 
						 ?>
						 </td>
					</tr>
					<tr>
						<td colspan="2">
						<b>
						<font size="5" color="black" face="arial">
						 <?php 
						 echo $row['msg'];
						 ?>
						 </font>
						 </b>
						 
						 </td>
					</tr>
					
					</table>
			</div>
		</div>
						<br>						
						
						
	<b>					
	<?php
	}
	else
		echo "<h1><center>NO posts yet!!!</center>";
	?>

	<script>

function logout() 
	{
 	 //if(confirm('Do you want to continue with payment?'));
	alert('Logging out!!! See you soon');
	}
</script>
	
	




</body>

</html>
<?php
}
?>