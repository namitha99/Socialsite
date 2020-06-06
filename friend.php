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
		where profile_id!='$id'
		order by time desc
		limit 0,20";
		
		$result = mysql_query($selectPost,$conn);
		
		
  
		
	}

?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PROFILE PAGE</title>

</head>
<style>
.abtn{
	background:IMAGE-URL;
	display:block;
	height:IMAGE-HEIGHT;
	width:IMAGE-WIDTH;
	}
button {
						  border: none;
						  outline: 0;
						  display: inline-block;
						  padding: 8px;
						  color: white;
						  //background-color: #000;
						  text-align: center;
						  cursor: pointer;
						  width: 100%;
						  font-size: 18px;
						}
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
#left
{
background: RGBA(7,40,0,0.4);
//background: RGBA(195,100,90,0.5);
	width:400px;
position:absolute;
left:10px;
margin-top:20px;
//z-index:-1;
}
#middle
{
background: RGBA(7,40,0,0.4);
//background: RGBA(195,100,90,0.5);
	width:400px;
position:absolute;
left:480px;
margin-top:20px;
//z-index:-1;
}
#right
{
background: RGBA(7,40,0,0.4);
//background: RGBA(195,100,90,0.5);
	width:400px;
position:absolute;
left:950px;
margin-top:20px;
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
			<input type="submit" name="home" value="home" formaction="profile.php" id="button">
			</td>
			
		
			<td>		
			<input type="submit" name="logout" value="logout" onclick="logout()" formaction="logout.php" id="button">
			</td>

						
		</tr>	
				
	</table>
	</form>
</div>

		
		<div   id="left">
			<h1>Your friends<h1>
			<?php
			/* display the users friends by selecting only those users whose id is present in friends table*/
			$yourFriends="select username
			from login l
			where profile_id in(select profile_id1 
							from friend
							where profile_id2='$id'
							union
							select profile_id2 
							from friend
							where profile_id1='$id'
							)";
			
			if(mysql_query($yourFriends,$conn))
			{
				$yourfriend_result=mysql_query($yourFriends,$conn);
				$num=mysql_num_rows($yourfriend_result);
				while($row= mysql_fetch_array($yourfriend_result)) 
				{
			?>
			<form>
			<table>
			<tr>
				<td>
				<font size="5" color="black" face="arial">
				<?php
				echo $row['username']
				?>
				</font>
				</td>
			</tr>
			</table>
			</form>
			<?php
				}
			}
			
			?>
		</div>
		
		<div   id="middle">
			<h1>Request<h1>
			<?php
			/*select only the pending requests from the request table*/
			$friendRequest="select l.username,l.profile_id
							from login l,request r
							where l.profile_id=r.profile_id
							and r.sent_to='$id'";
			if(mysql_query($friendRequest,$conn))
			{
				$friendReq_res=mysql_query($friendRequest,$conn);
				while($row= mysql_fetch_array($friendReq_res)) 
				{
			?>
			<form>
			<table>
			<tr>
				<td>
				<font size="5" color="black" face="arial">
				<?php
				echo $row['username']
				?>
				</td>
				<td>
				<button>
				<?php
					$sendto_id=$row['profile_id'];
					echo "<a href=\"acceptrequest.php?sendtoid=$id&fromid=$sendto_id\" class=abtn> Accept request </a>";
			
				?>
				</button>
				
				</font>
				</td>
				<td>
				<button>
				<?php
					$sendto_id=$row['profile_id'];
					echo "<a href=\"rejectrequest.php?sendtoid=$sendto_id&fromid=$id\" class=abtn> Reject request </a>";						 
				?>
				</button>
				
				</font>
				</td>
			</tr>
			</table>
			</form>
			<?php
				}
			}
			?>
		</div>
		
		<div  id="right">
			<h1>All users<h1>
			<?php
			$yourFriends="(select profile_id1 as profileid
							from friend
							where profile_id2='$id')
							union
							(select profile_id2 as profileid
							from friend
							where profile_id1='$id'
							)";
			$yourfriend_result=mysql_query($yourFriends,$conn);
			$num=mysql_num_rows($yourfriend_result);
			if($num==0)
			{ /* create a view for easy computation and after execution delete the created view for space optimization*/
				$allUser="create view temp as
				select username,profile_id
						from login
						where profile_id not in (select profile_id
										from request
										where sent_to='$id'
										union
										select sent_to
										from request
										where profile_id='$id')
						and profile_id!='$id'
						";
			}else
			{ 
			$allUser="create view temp as
			select username,profile_id
					from login
					where profile_id not in((select profile_id1 as profileid
							from friend
							where profile_id2='$id'
							union
							select profile_id2 as profileid
							from friend
							where profile_id1='$id'
							))
					and profile_id!='$id'
					";
			}
			if(mysql_query($allUser,$conn))
			{	$other_user="select username,profile_id
				from temp
				where profile_id not in(select profile_id 
                       from request
                       where sent_to='$id'
                       union
                       select sent_to
                       from request
                       where profile_id='$id')";
				$other_user_res=mysql_query($other_user,$conn);
				while($row= mysql_fetch_array($other_user_res)) 
				{
			?>
			<form>
			<table>
			<tr>
				<td>
				<font size="5" color="black" face="arial">
				<?php
				echo $row['username']
				?>
				</td>
				<td>
				<button>
				<?php
					$sendto_id=$row['profile_id'];
					echo "<a href=\"request.php?sendtoid=$sendto_id&fromid=$id\" class=abtn> Send request </a>";						 
				?>
				</button>
				
				</font>
				</td>
			</tr>
			</table>
			</form>
			<?php
				}
			}
			$drop="drop view temp";
			mysql_query($drop,$conn);
			?>
		</div>

	<script>

function logout() 
	{
 	 //if(confirm('Do you want to continue with payment?'));
	alert('Logging out!!! See you soon');
	}
</script>
	
	




</body>

</html>
