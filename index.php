<?php 
session_start();

if ($_SESSION["User"] != "" && $_SESSION["User"] != null) {

	echo "You are currently logged in as " . $_SESSION["User"];
}
else {

	//redirect user back to login.php if the session does not exist
	header('Location: login.php');
}

if (!isset($_GET["loggedIn"])) {

	SignOut();
}

function SignOut() {

	$_SESSION["User"] = "";
	session_destroy();

	//redirect user back to login.php if the session does not exist
	header('Location: login.php');
}

?>
<html>
<body>
<span><a href="login.php">Sign Out</a></span>


</body>
</html>