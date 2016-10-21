<?php
if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}

//database configuration
$host = '127.0.0.1';
$user = 'root';
$pass = 'machowhizfish';
$db = 'medit8';

mysql_connect($host, $user, $pass) or die("MySQL Error: " . mysql_error());
mysql_select_db($db) or die("MySQL Error: " . mysql_error());


?>
