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
			<th>Name</th>
			<th>Description</th>
			<th>Dates</th>
			<th></th>
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
$femaleAllocations = 0;
$maleAllocations = 0;
//if query resulted in any rows
if(mysql_num_rows($courses) > 0){
    while($row = mysql_fetch_array($courses)){
    	//if the user has a gender assigned

    	if(isset($_SESSION) && $_SESSION['LoggedIn'] == 1 && $_SESSION['gender'] != NULL){
    	
    		//get the age group for the course and the user's gender
    		$ageQuery = "SELECT min(age) as min_age, max(age) as max_age FROM accounts INNER JOIN allocations ON accounts.email=allocations.account WHERE Gender=".$_SESSION['gender']." AND Course =".(string)$row['id'];
    		$ageResult =  mysql_fetch_array(mysql_query($ageQuery)) or die("Error in query. ".mysql_error());
    		if($ageResult['min_age'] != NULL){
    			if($ageResult['min_age'] != $ageResult['max_age']){$ageRange = $ageResult['min_age'].'-'.$ageResult['max_age'];}
    			else{$ageRange = 'around '.$ageResult['min_age'];}
    		}
    		//get the number of the user's gender enroled in the course
    		$allocationsQuery = "SELECT COUNT('Gender') FROM accounts INNER JOIN allocations ON accounts.email=allocations.account WHERE Gender=".$_SESSION['gender']." AND Course =".(string)$row['id'];
    		$allocationsResult = mysql_query($allocationsQuery) or die("Error in query. ".mysql_error());
    		$numberOfAllocations = mysql_fetch_array($allocationsResult)["COUNT('Gender')"];
    	
			//if the dorm appropriate to the user's gender is full
        	if($numberOfAllocations > 25){
        		$registerable = 0; //-1 = closed, 0 = will be open in the future or is full, 1 = open;
        		echo '<tr style="background-color: lightcoral">';}
	
	        //if enrolment is open
	        elseif(strtotime ($row['StartDate']) > time() && strtotime( '-2 month' , strtotime ($row['StartDate'])) < time() ){
	        	$registerable = 1;
	        	echo '<tr style="background-color: lightgreen">';}
	        
        	//if the course is not yet open for enrolment
    		elseif(strtotime( '-2 month' , strtotime ($row['StartDate'])) > time() ){
    		$registerable = 0;
        		echo '<tr style="background-color: lightcyan">';}

        
	        //the only other option is that enrolment is closed
	        else{
	        	$registerable = -1;
	        	echo '<tr style="background-color: lightcoral">';}
	        
	        //Creating the table row using the parameters set in the previous conditional
	        	    echo '<td>'.$row['Name'].'</td>';
	        	    
	        	    echo '<td>'.$row['Description'];
	        	    if($numberOfAllocations > 25){
	        	    	if($_SESSION['gender'] == 0){echo ' Female dorm is full.';}
	        	    	if($_SESSION['gender'] == 1){echo ' Male dorm is full.';}
	        	    }
	        	    elseif($ageResult['min_age'] != NULL){
	        	    	echo ' Current age group is '.$ageRange;
	        	    }
					echo '</td>';
					
	    	        echo '<td>Enrollment opens: '.date ( 'd-m-Y', strtotime( '-2 month' , strtotime ($row['StartDate']))).'<br />';
	    	        echo 'Course starts: '.date ( 'd-m-Y', strtotime($row['StartDate'])).'<br/>';
	    	        echo 'Course ends: '.date( 'd-m-Y', strtotime('+'.$row['Duration'].' day', strtotime($row['StartDate']))).'</td>';
	    	        echo '<td>';
	    	        
	    	        if($registerable == 0){ 
	    	        //mailing list for course openenings needs to go here
    						echo '<input name="MailingListButton" type="button" value="Register for updates" />';
					}

	    	        elseif($registerable == 1){
	    	        	echo '<form method="post" action="courseRegistration.php">';
    						echo '<input type="hidden" name="course" value='.$row['id'].'>';
    						echo '<input name="EnrolButton" type="submit" value="Enrol in course"/>';
						echo '</form>';
	    	        }
	    	        else{echo 'Course registration closed.';}
	    	        echo '</td>';
	        	echo '</tr>';
	    }
	    
	    	    
	    
    	//if the user does not have a gender assigned
    	else{
    		//get the number of males enroled in the course
    		$allocationsQuery = "SELECT COUNT('Gender') FROM accounts INNER JOIN allocations ON accounts.email=allocations.account WHERE Gender=1 AND Course =".(string)$row['id'];
    		$allocationsResult = mysql_query($allocationsQuery) or die("Error in query. ".mysql_error());
    		$maleAllocations = mysql_fetch_array($allocationsResult)["COUNT('Gender')"];
    		
    		//get the number of females enroled in the course
    		$allocationsQuery = "SELECT COUNT('Gender') FROM accounts INNER JOIN allocations ON accounts.email=allocations.account WHERE Gender=0 AND Course =".(string)$row['id'];
    		$allocationsResult = mysql_query($allocationsQuery) or die("Error in query. ".mysql_error());
    		$femaleAllocations = mysql_fetch_array($allocationsResult)["COUNT('Gender')"];
    		    		
    		//if both the male and female dorms are full
        	if($maleAllocations > 25 && $femaleAllocations > 25){
        		$registerable = 0; //-1 = closed, 0 = will be open in the future or is full, 1 = open;
        		echo '<tr style="background-color: lightcoral">';}
	
	        //if enrolment is open
	        elseif(strtotime ($row['StartDate']) > time() && strtotime( '-2 month' , strtotime ($row['StartDate'])) < time() ){
	        	$registerable = 1;
	        	echo '<tr style="background-color: lightgreen">';}
	        
        	//if the course is not yet open for enrolment
    		elseif(strtotime( '-2 month' , strtotime ($row['StartDate'])) > time() ){
    		$registerable = 0;
        		echo '<tr style="background-color: lightcyan">';}

        
	        //the only other option is that enrolment is closed
	        else{
	        	$registerable = -1;
	        	echo '<tr style="background-color: lightcoral">';}
	        
	        //Creating the table row using the parameters set in the previous conditional
	        	    echo '<td>'.$row['Name'].'</td>';
	        	    echo '<td>'.$row['Description'];
	        	    if($femaleAllocations > 25){echo ' Female dorm is full.';}
	        	    if($maleAllocations > 25){echo ' Male dorm is full.';}
					echo '</td>';
	    	        echo '<td>Enrollment opens: '.date ( 'd-m-Y', strtotime( '-2 month' , strtotime ($row['StartDate']))).'<br />';
	    	        echo 'Course starts: '.date ( 'd-m-Y', strtotime($row['StartDate'])).'<br/>';
	    	        echo 'Course ends: '.date( 'd-m-Y', strtotime('+'.$row['Duration'].' day', strtotime($row['StartDate'])));
	    	        echo '</td>';
	    	        echo '<td>';
	    	        if($registerable == -1){echo 'Course registration closed.';}
	    	        elseif($registerable == 0){echo 'Course registration not currently open.';}
	    	        else{echo 'Course registration open.';}
	    	        echo '</td>';
	        	echo '</tr>';
	    	}

		}
		
		
    }

?>
</table>

</body>

</html>
