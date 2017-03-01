<?php


echo "Login Form";


?>

<html>
<body>

<!-- LOGIN FORM -->
<form action="scripts/validateUser.php" method="post">
Email: <input type="text" name="email" />
Password: <input type="password" name="password" />
<input type="submit" value="Login" name="submitLogin"/>

<span><a href="register.php">Register Here</a></span><br/>


</form>
<?php
if ( isset($_GET['loginSuccess']) && !empty($_GET['loginSuccess']) && $_GET['loginSuccess'] == 'false' ) { 
	
	echo "You have entered an invalid email and password combination.";
}

if ( isset($_GET['passChange'])&& !empty($_GET['passChange']) && $_GET['passChange'] == 'true' ) {

	echo "You must log back in after changing your password.";
}


?>


</body>
</html>