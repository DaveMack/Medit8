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

<?php
//including configuration file
include('conf.php');
//connecting to database
$_connection = mysql_connect($host, $user, $pass) or die("Unable to connect to database.");
//selecting database
mysql_select_db($db) or die("Unable to select database");
//building database query
$Email = mysql_real_escape_string($_SESSION['EmailAddress']);
$Course = $_POST['course'];
if($_SESSION['gender'] == 0){$Room = 2;} else{$Room = 1;}
$registerQuery = "INSERT INTO `allocations` (`id`, `Course`, `Account`, `Room`) VALUES (Null, '".$Email ."', '".$Course ."', '".$Room ."')" or die("Error in query. ".mysql_error()) ;
echo 'Registered for course'
?>
</body>

</html>
