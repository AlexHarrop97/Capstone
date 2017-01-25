<?php

// This file does the completes the login, uses are sent here from the login page
// login.php is the default page of the website.

require_once('db.php');

try {

	// Select all using user and password textboxes on login.php
	$stmt = $db->prepare("SELECT * FROM users WHERE (Email LIKE :email AND P4WD LIKE :pass)");
	$stmt->bindParam(':email', $Email);
	$stmt->bindParam(':pass', $Password);

	$Email = $_POST["email"];
	$Password = $_POST["password"];

	$stmt->execute();
	$users = $stmt->fetchAll();
	
	
	// start the session, set the session variable for User
	// then redirect back to index.php
	session_start();

	// check the user to see if it exists within the database
	foreach ($users as $user) {

		if ($user['Email'] == $Email) {

			$_SESSION["User"] = $user["Email"];

			//redirect user back to homepage
			header('Location: index.php?loggedIn=true');
		}
		else {

			header('Location: index.php?loggedIn=false');
		}
	}
}
catch (PDOException $e) {
	
	die('Sign In Failed! ');
}


?>