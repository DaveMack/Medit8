<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Untitled 1</title>
</head>

<body>
<!-- THIS ISN"T WORKING RIGHT NOW
<?php
//including configuration file
include('conf.php')
//connecting to database
$connection = mysql_connect($host, $user, $pass) or die("Unable to connect to database.");
//selecting database
mysql_select_db($db) or die("Unable to select database");
//building database query
$query = "SELECT * from 'Courses' ORDER BY 'StartDate'";
//querying server
$result = mysql_query($query) or die("Error in query. ".mysql_error());

//if query resulted in any rows
if(mysql_num_rows($result) > 0){
	//iterate through results and print to table
	while($row = mysql_fetch_object($result)){
	?>
	<tr style="background-color: aqua">
		<td><?php echo $row['id'] ?></td>
		<td><?php echo $row['Name'] ?></td>
		<td><?php echo $row['Description'] ?></td>
		<td>Enrollment opens: 00/00/00<br />
		<?php echo $row['StartDate'] ?><br/>
		Course ends: 00/00/00</td>
	<?php
	}
}
		
?>	-->
<!--login form
<div class="PageHeading">
	<header>
		Medit8 School for Zen Life Improvement</header>
	<form action="" class="LoginForm" method="POST">
		<label for="Username">Username</label>
		<input name="Username" type="text" value="" />&nbsp;&nbsp;&nbsp;
		<label for="Password">Password</label>
		<input name="Password" type="password" />
		<input name="LoginSubmit" type="submit" value="Login/Register" /> <br />
		<br />
	</form>
</div>
-->

</body>

</html>
