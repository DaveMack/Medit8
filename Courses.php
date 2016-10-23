<!DOCTYPE html>
<html>

<head>
<meta content="en-au" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Medit8 - Courses</title>
<link href="StyleSheet.css" rel="stylesheet" type="text/css" />
</head>

<body>
<!--Imports the website header-->
<?php include 'header.php' ?>

<!--Creating the table of classes. This uses php to write dynamic HTML-->
	<table class="ListTable">
		<caption class="Caption">Classes</caption>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Description</th>
			<th>Dates</th>
		</tr>
		
<?php
//including configuration file
include('conf.php');
//connecting to database
$_connection = mysql_connect($host, $user, $pass) or die("Unable to connect to database.");
//selecting database
mysql_select_db($db) or die("Unable to select database");
//building database query
$query = "SELECT * FROM `courses` ORDER BY `StartDate`";
$allocations_query = "SELECT courses FROM allocations WHERE Account LIKE '".$email."'";
//querying server
$result = mysql_query($query) or die("Error in query. ".mysql_error());
$allocations_result = mysql_query($allocations_query) or die("Error in query. ".mysql_error());
//if query resulted in any rows
if(mysql_num_rows($result) > 0){
    while($row = mysql_fetch_array($result)){
		while($a_row = mysql_fetch_array($allocations_result)){
			//if the course is not yet open for enrolment
			if(strtotime( '-2 month' , strtotime ($row['StartDate'])) > time() ){
			echo '<tr style="background-color: lightcyan">';}
			
			//if enrolment is closed
			elseif(strtotime ($row['StartDate']) > time() ){
			echo '<tr style="background-color: lightgreen">';}
			
			//if user has passed course
			elseif($a_row['Name'] = $row['Name'] AND strtotime ('+'.$a_row['Duration'].' day', strtotime($a_row['StartDate'])) > time()){
				echo '<tr style="background-color: lightsalmon">';
			}
			
			//the only other option is that enrolment is closed
			else{
			echo '<tr style="background-color: lightcoral">';}
			
			//Creating the table row using the parameters set in the previous conditional
				echo '<td>'.$row['id'].'</td>';
				echo '<td>'.$row['Name'].'</td>';
				echo '<td>'.$row['Description'].'</td>';
				echo '<td>Enrollment opens: '.date ( 'd-m-Y', strtotime( '-2 month' , strtotime ($row['StartDate']))).'<br />';
				echo 'Course starts: '.date ( 'd-m-Y', strtotime($row['StartDate'])).'<br/>';
				echo 'Course ends: '.date( 'd-m-Y', strtotime('+'.$row['Duration'].' day', strtotime($row['StartDate']))).'<input name="Button1" type="button" value="enrol" /></td>';
			echo '</tr>';
		}
    }
}
?>
</table>

</body>

</html>
