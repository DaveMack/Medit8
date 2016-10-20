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
echo 'test'

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
$coursesQuery = "SELECT * FROM `courses` ORDER BY `StartDate`";
//querying server
$courses = mysql_query($coursesQuery) or die("Error in query. ".mysql_error());

//if query resulted in any rows
if(mysql_num_rows($courses) > 0){
    while($row = mysql_fetch_array($courses)){
    	//if more than 26 accounts regested in current course are same gender as current login
    	$allocationsQuery = "SELECT COUNT('Gender') FROM accounts INNER JOIN allocations ON accounts.email=allocations.account WHERE Gender=".$_SESSION['gender']." AND Course=".(string)$row['id'];
    	$allocationsResult = mysql_query($allocationsQuery) or die("Error in query. ".mysql_error());
    	$numberOfAllocations = mysql_fetch_array($allocationsResult)["COUNT('Gender')"];
        if($numberOfAllocations > 25){
        echo '<tr style="background-color: lightcoral">';}

        //if enrolment is open
        elseif(strtotime ($row['StartDate']) > time() && strtotime( '-2 month' , strtotime ($row['StartDate'])) < time() ){
        echo '<tr style="background-color: lightgreen">';}
        
        //if the course is not yet open for enrolment
    	elseif(strtotime( '-2 month' , strtotime ($row['StartDate'])) > time() ){
        echo '<tr style="background-color: lightcyan">';}

        
        //the only other option is that enrolment is closed
        else{
        echo '<tr style="background-color: lightcoral">';}
        
        //Creating the table row using the parameters set in the previous conditional
            echo '<td>'.$row['id'].'</td>';
            echo '<td>'.$row['Name'].'</td>';
            echo '<td>'.$row['Description'];
            if($numberOfAllocations > 25){echo ' Class is full.';}
			echo '</td>';
            echo '<td>Enrollment opens: '.date ( 'd-m-Y', strtotime( '-2 month' , strtotime ($row['StartDate']))).'<br />';
            echo 'Course starts: '.date ( 'd-m-Y', strtotime($row['StartDate'])).'<br/>';
            echo 'Course ends: '.date( 'd-m-Y', strtotime('+'.$row['Duration'].' day', strtotime($row['StartDate'])));
            if($numberOfAllocations > 25){echo '<a style="" href="mailingList.php">Join mailing list</a>';}
            else{echo '<a style="" href="Enrol.php" >Enrol in course"</a>';}
            echo '</td>';
        echo '</tr>';
    }
}
?>
</table>

</body>

</html>
