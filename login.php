<?php



?>

<html>
<body>

<!-- LOGIN FORM -->
<form action="scripts/validateUser.php" method="post">
Email: <input type="text" name="email" />
Password: <input type="password" name="password" />
<input type="submit" />

<span><a href="register.php">Register Here</a></span><br/>
<?php
if ($_GET["loginSuccess"] == 'false') { 

	echo "You have entered an invalid email and password combination.";

}


?>
</form>


</body>
</html>