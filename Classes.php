<!DOCTYPE html>
<html>

<head>
<meta content="en-au" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Medit8</title>
<link href="StyleSheet.css" rel="stylesheet" type="text/css" />
</head>

<body>

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
<section>
	<table align="center" class="ClasesTable">
		<caption style="background: white; font-size: xx-large; font-weight: bolder;">
		Classes</caption>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Description</th>
			<th>Dates</th>
		</tr>
		<tr style="background-color: chartreuse">
			<td>000</td>
			<td>Example</td>
			<td>This is an example class to be used until the page can call information 
			from the database.</td>
			<td>Enrollment opens: 00/00/00<br />
			Course starts: 00/00/00<br />
			Course ends: 00/00/00</td>
		</tr>
		<tr style="background-color: crimson">
			<td>000</td>
			<td>Example</td>
			<td>This is an example class to be used until the page can call information 
			from the database.</td>
			<td>Enrollment opens: 00/00/00<br />
			Course starts: 00/00/00<br />
			Course ends: 00/00/00</td>
		</tr>
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
		
?>
	</table>
</section>

</body>

</html>
