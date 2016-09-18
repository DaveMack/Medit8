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
echo var_dump($_connection);
//selecting database
mysql_select_db($db) or die("Unable to select database");
//building database query
$query = "SELECT * FROM `Courses` ORDER BY `StartDate`";
//querying server
$result = mysql_query($query) or die("Error in query. ".mysql_error());
echo var_dump($result);
/////////////////////////
//Learn to use PDO here//
/////////////////////////

//if query resulted in any rows
if(mysql_num_rows($result) > 0){
    while($row = mysql_fetch_array($result)){
        echo '<tr style="background-color: aqua">';
            echo '<td>'.$row['id'].'</td>';
            echo '<td>'.$row['Name'].'</td>';
            echo '<td>'.$row['Description'].'</td>';
            echo '<td>Enrollment opens: '.date ( 'd-m-Y', strtotime( '-2 month' , strtotime ($row['StartDate']))).'<br />';
            echo 'Course starts: '.date ( 'd-m-Y', strtotime($row['StartDate'])).'<br/>';
            echo 'Course ends: '.date( 'd-m-Y', strtotime('+'.$row['Duration'].' day', strtotime($row['StartDate']))).'</td>';
        echo '</tr>';
    }
}
?>
</table>

</body>

</html>
