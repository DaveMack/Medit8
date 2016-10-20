<!DOCTYPE html>
<html>

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Medit8 - NavBar</title>
<?php include 'conf.php' ?>
<?php //include 'testLogin.php' ?>
</head>

<body>
	<header>
			<?php
			if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['EmailAddress']))
			{
			     ?>
			 
			 		<a href="logout.php">Logout <?=$_SESSION['username']?></a>
			    <?php
			}
			elseif(!empty($_POST['Email']) && !empty($_POST['Password']))
			{
			    $email = str_replace ('.', '_', mysql_real_escape_string($_POST['Email']));
			    $password = md5(mysql_real_escape_string($_POST['Password']));
			     
			    $checklogin = mysql_query("SELECT * FROM accounts WHERE Email LIKE '".$email."' AND Password = '".$password."'");
			     
			    if(mysql_num_rows($checklogin) == 1)
			    {
			        $row = mysql_fetch_array($checklogin);
			        $username = $row['Name'];
			         
			        $_SESSION['username'] = $username;
			        $_SESSION['EmailAddress'] = $email;
			        $_SESSION['LoggedIn'] = 1;
			    	 ?>
			 
			 		<a href="logout.php">Logout <?=$_SESSION['username']?></a>
			    	<?php 
			    }
			    else
			    {
			        echo "<h1>Error</h1>";
			        echo "<p>Sorry, your account could not be found. Please <a href=\"index.php\">click here to try again</a>.</p>";
			    }
			}
			else
			{
	    		 ?>
	    		 	<button id="myBtn">Login</button>
 
	     		<?php
	     	}
	    	 ?>	

		Medit8 School for Zen Life Improvement

	</header>

	<nav>
		<br>
	<br>
	<br>
		<ul>
			<li></li>
			<li><a href="index.php">Home</a></li>
			<li><a href="Courses.php">Courses</a></li>
			<li><a href="WaysToGive.php">Ways to Give</a></li>
			<li><a href="Directions.php">Direction</a></li>
			<li><a href="Account.php">Account</a></li>
			<li></li>
		</ul>
	</nav>
	<br>
	<br>
	<br>
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times</span>
      <h2>Member Login</h2>
    </div>
    <div class="modal-body">
     
   <p>Thanks for visiting! Please either login below, or <a href="register.php">click here to register</a>.</p>
     
    <form method="post" action="index.php" name="loginform" id="loginform">
    <fieldset>
        <label for="Email">Email:</label><input type="text" name="Email" id="Email"  autofocus/><br />
        <label for="Password">Password:</label><input type="Password" name="Password" id="Password" /><br />
        <input type="submit" name="login" id="login" value="Login" />
    </fieldset>
    </div>
    <div class="modal-footer">
      <h3>Medit8 Member Login Footer</h3>
    </div>
  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
	
</body>

</html>
