<?php


?>

<html>
<body>

<!-- LOGIN FORM -->
<form action="scripts/validateUser.php" method="post">
<table>
    <th><h2>Login</h2></th>
    <tr><td>Email Address:</td><td><input type="text" name="email" /></td></tr>
    <tr><td>Password:</td><td><input type="password" name="password" /></td></tr>
    <tr><td></td><td><input type="submit" /></td></tr>
</table>
</form>

<span><a href="register.php">Register Here</a></span><br/>

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