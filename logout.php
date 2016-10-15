<?php include "conf.php"; $_SESSION = array(); session_destroy(); 
$_SESSION['LoggedIn'] = 0; ?>
<meta http-equiv="refresh" content="0;index.php">