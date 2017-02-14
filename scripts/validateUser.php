<?php

// This file completes the login, users are sent here from the login page
// login.php is the default page of the website.

require_once('../dependencies/db.php');

try {

	// Select all using user and password textboxes on login.php
	$stmt = $db->prepare("SELECT * FROM users");

	$stmt->execute();
	$users = $stmt->fetchAll();
	
	// start the session, set the session variable for User
	// then redirect back to index.php
	session_start();

	// check the user to see if it exists within the database
	foreach ($users as $user) {

					
		// if the user does not exists(if the email in the db is null)
		// send the user back to login.php
		if ($user['Email'] != $_POST["email"] || !password_verify($_POST["password"], $user["P4WD"])) {

			header('url: ../login.php');
		}
		
		else {
			// if the user exists(checking a valid email and password combo)
			// set a session variable and send the user to index.php
			$_SESSION["User_ID"] = $user["User_ID"];
			$_SESSION["User_FName"] = $user["FirstName"];
			$_SESSION["User_LName"] = $user["LastName"];
			$_SESSION["User_Email"] = $user["Email"];
			echo $_SESSION["User"];

			//redirect user back to homepage
			header('Location: ../index.php');
		}
	}
}
catch (PDOException $e) {
	
	die('Sign In Failed! ');
}
?>


	
