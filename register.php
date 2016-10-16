<?php include "conf.php"; ?>
<!DOCTYPE html>
<html>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
 
<title>Medit8 Member Login</title>
<link href="StyleSheet.css" rel="stylesheet" type="text/css" />
</head>  
<body>  
<div id="main">
<?php
if(!empty($_POST['Email']) && !empty($_POST['Password']))
{
    $username = mysql_real_escape_string($_POST['Name']);
    $password = md5(mysql_real_escape_string($_POST['Password']));
    $email = mysql_real_escape_string($_POST['Email']);
    $street = mysql_real_escape_string($_POST['Address']);
    $age = mysql_real_escape_string($_POST['Age']);
    $gender = $_POST['Gender'];

     
     $checkusername = mysql_query("SELECT * FROM accounts WHERE Email = '".$email."'");
      
     if(mysql_num_rows($checkusername) == 1)
     {
        echo "<h1>Error</h1>";
        echo "<p>Sorry, that email is taken. Please go back and try again.</p>";
     }
     else
     {
        $registerquery = mysql_query("INSERT INTO accounts (Name, Password, Email, Address, Age, Gender) 
            VALUES('".$username."', '".$password."', '".$email."', '".$street."', '".$age."', '".$gender."')");
        if($registerquery)
        {
            echo "<h1>Success</h1>";
            echo "<p>Your account was successfully created. Please <a href=\"index.php\">click here to login</a>.</p>";
        }
        else
        {
            echo "<h1>Error</h1>";
            echo "<p>Sorry, your registration failed. Please go back and try again.</p>";
        }       
     }
    }
    else
    {
        ?>
         
       <h1>Register</h1>
         
       <p>Please enter your details below to register.</p>
         
        <form method="post" action="register.php" name="registerform" id="registerform">
        <fieldset>
            <label for="Name">Username:</label><input type="text" name="Name" id="Name"  autofocus /><br />
            <label for="Password">Password:</label><input type="Password" name="Password" id="Password" /><br />
            <label for="Email">Email Address:</label><input type="text" name="Email" id="Email" /><br />
            <label for="Address">Street Address:</label><input type="text" name="Address" id="Address" /><br />
            <label for="Age">Age:</label><input type="number" name="Age" id="Age" min="1" max="99"/><br />
            <input type="radio" name="Gender" value="1" checked> Male<br>
            <input type="radio" name="Gender" value="0"> Female<br>

            <input type="submit" name="register" id="register" value="Register" />
            <input type="reset" name="reset" id="reset" value="Clear Form" />
        </fieldset>
        </form>
         
        <?php
    }
    ?>
     
    </div>
    </body>
    </html>