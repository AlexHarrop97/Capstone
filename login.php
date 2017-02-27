<?php




?>

<html>
<body>

<p><strong>Error: </strong>Class <em>brendanize.php </em>contains errors on lines: 5, 8, 20, 60 near either ';' or '}'. Please consult the php and mysql documentation for more details(error only occurs if you have a brendan working on a project with you).</p>
<!-- LOGIN FORM -->
<form action="scripts/validateUser.php" method="post">
Email: <input type="text" name="email" />
Password: <input type="password" name="password" />
<input type="submit" />

<span><a href="register.php">Register Here</a></span><br/>
<?php
if ( isset($_GET['loginSuccess']) && !empty($_GET['loginSuccess']) && $_GET['loginSuccess'] == 'false' ) { 
	
	echo "You have entered an invalid email and password combination.";
}
else if ( isset($_GET['passChange']) && !empty($_GET['passChange']) && $_GET['passChange'] == 'true' ) {

	echo "You must log back in after changing your password.";
}


?>
</form>


</body>
</html>