<?php
require_once('dependencies/db.php');

session_start();

// check if the session exists(it should have been created in validateUser.php)
// if it exists, send the user back to index and display the logged in message
// if not, send the user back to login.php with a message reading "the account does not exist"
if ( isset($_SESSION["User_ID"]) != "" ) {

	echo "You are currently logged in as <strong>" . $_SESSION["User_FName"] . " " . $_SESSION["User_LName"] . "</strong>";
	echo "<br/>";
	echo "You have a user id of " . $_SESSION["User_ID"] . " (at some point this might be important to you)";
	
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
<!-- CHANGE PASSWORD -->
<form action="scripts/changePass.php GrabComments()" method="post">
New Password: <input type="password" name="newPass" />
Confirm New Password: <input type="password" name="newPassConfirm" />
<input type="submit" value="Change Password" name="submitPassChange" />
</form>

<!-- SEND COMMENT -->
<form action="scripts/sendComments.php" method="post">
	<input type="textarea" name="msgBox" value=""></input>
	<input type="submit" value="Send" name="submitMsg" />
</form>

<!-- GRAB COMMENTS -->
<?php

try {

	$getComments = $db->prepare('SELECT * FROM comments c JOIN users u ON u.User_ID = c.User_ID ORDER BY Message_Time DESC');
	//$getComments->bindParam(':projectID', $_GET["Project_ID"]);
	$getComments->execute();
	$results = $getComments->fetchAll();

	foreach ($results as $line) {

		$template = "<p><strong>" . $line["User_FName"] . " " . $line["User_LName"] . "</strong> (" . $line["Message_Time"] . "):" . $line["Message_Text"] . ".</p><br/>";

		echo $template;
	}

}
catch (PDOException $e) {

	echo "Query Failed: " . $e->getMessage();
}


?>






<a href="profile.php">
<a href="todo.php">
<a href="comments.php">
</body>
</html>