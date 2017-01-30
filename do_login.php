<?php

// This file does the completes the login, uses are sent here from the login page
// login.php is the default page of the website.

require_once('db.php');

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

		if ($user['Email'] == $_POST["email"] && password_verify($_POST["password"], $user["P4WD"])) {

			$_SESSION["User"] = $user["Email"];
			echo $_SESSION["User"];

			//redirect user back to homepage
			//header('Location: index.php?key=' . $user["password"]);
		}
		else if ($user["Email"] == null){

			header('Location: login.php?');
		}
	}
}
catch (PDOException $e) {
	
	die('Sign In Failed! ');
}

// Select all using user and password textboxes on login.php
//$stmt = $db->prepare("SELECT * FROM users WHERE (Email=:email AND P4WD=:pass)");
//$stmt->bindParam(':email', $Email);
//$stmt->bindParam(':pass', $Password);
?>


	
