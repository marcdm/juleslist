<?php include_once 'base.php';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
<title>User Management System</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>  
<body>  
<div id="main">
<?php
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
{
	 ?>

	 <h1>Member Area</h1>
     <p>Thanks for logging in! You are <b><?=$_SESSION['Username']?></b> and your email address is <b><?=$_SESSION['EmailAddress']?></b>.</p>
     <p><a href="logout.php">Logout</a></p>
     <?php
}
elseif(!empty($_POST['username']) && !empty($_POST['password']))
{
    
    $username = $db->escape($_POST['username']);
    $password = md5($db->escape($_POST['password']));//.$salt);
    
    $checklogin = $db->get_row("SELECT * FROM users WHERE username = '".$username."' AND password = '".$password."'");

    if (isset($checklogin))
    {
    	$row = $checklogin;
        
        $email = $row->email;
        
        $_SESSION['Username'] = $username;
        $_SESSION['EmailAddress'] = $email;
        $_SESSION['LoggedIn'] = 1;
        
    	echo "<h1>Success</h1>";
        echo "<p>We are now redirecting you to the member area.</p>";
        echo "<meta http-equiv='refresh' content='=2;../index.php' />";
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
    
   <h1>Member Login</h1>
    
   <p>Thanks for visiting! Please either login below, or <a href="register.php">click here to register</a>.</p>
    
	<form method="post" action="index.php" name="loginform" id="loginform">
	<fieldset>
		<label for="username">Username:</label><input type="text" name="username" id="username" /><br />
		<label for="password">Password:</label><input type="password" name="password" id="password" /><br />
		<input type="submit" name="login" id="login" value="Login" />
	</fieldset>
	</form>
    
   <?php
}
?>

</div>
</body>
</html>
