<?php

session_start();

// check if the session exists(it should have been created in validateUser.php)
// if it exists, send the user back to index and display the logged in message
// if not, send the user back to login.php with a message reading "the account does not exist"
if ( isset($_SESSION["User_ID"]) != "" ) {

	echo "You are currently logged in as <strong>" . $_SESSION["User_FName"] . " " . $_SESSION["User_LName"] . "</strong>";
	
}
else {

	//redirect user back to login.php if the session does not exist
	header('Location: login.php');
}

?>
<html>
<body>
<form action="scripts/logout.php" method="post"><input type="submit" value="Logout" /></form>

<?php

if ( isset($_SESSION["User_ID"]) != "" ) {

	echo "Change your password here: ";
	
}
else {

	//redirect user back to login.php if the session does not exist
	header('Location: login.php');
}
?>
<!-- CHANGE PASSWORD FORM -->
<form action="scripts/changePass.php" method="post">
Current Password: <input type="password" name="currentPass" />
New Password: <input type="password" name="newPass" />
Confirm New Password: <input type="password" name="newPassConfirm" />
<input type="submit" />


<a href="profile.php">
<a href="todo.php">
<a href="comments.php">
</body>
</html>