<?php
if (isset($_GET["status"])) {

	echo "This user does not exist within the database.";
}


?>
<html>
<body>

<!-- LOGIN FORM -->
<form action="do_login.php" method="post">
Email: <input type="text" name="email" />
Password: <input type="password" name="password" />
<input type="submit" />

<span><a href="register_user.php">Register Here</a></span>
</form>


</body>
</html>