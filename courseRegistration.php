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
<article>
<?php
//including configuration file
include('conf.php');
//connecting to database
//$_connection = mysql_connect($host, $user, $pass) or die("Unable to connect to database.");
//selecting database
//mysql_select_db($db) or die("Unable to select database");
//building database query
if($_SESSION['LoggedIn'] == 1 && $_POST['course'] > 0){
	$Email = mysql_real_escape_string($_SESSION['EmailAddress']);//example@example_com
	$SelectEmail = str_replace ('.', '_',$Email);

	$Course = $_POST['course'];
	if($_SESSION['gender'] == 0){$Room = 2;} else{$Room = 1;}
	$checkQuery = "SELECT * FROM `allocations` WHERE `Course` LIKE '".$Course."'AND `Account` LIKE '".$SelectEmail."';";
	$checkResult = mysql_query($checkQuery) or die("Error in query. ".mysql_error());
	if(mysql_num_rows($checkResult) > 0){
		echo 'Failed to register for course: you are already registered for this course.';
	}
	else{
		$registerQuery = "INSERT INTO `allocations` (`id`, `Course`, `Account`, `Room`) VALUES (Null, '".$Course."', '".$Email."', '".$Room ."');";
				$registerResult = mysql_query($registerQuery) or die("Error in query. ".mysql_error());
		echo "Successfully registered ".$Email." for course";
		$subject = 'Your enrolment';
		$message = 'You enrolled in something.  Good for you!';
		$headers = 'From: webmaster@medit8.com' . "\r\n" .
		'Reply-To: webmaster@medit8.com' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();

		mail($Email, $subject, $message, $headers);
	}
}
else{echo 'You aren\'t logged in! Why are you even on this page?';}
?>
</article>
</body>

</html>
