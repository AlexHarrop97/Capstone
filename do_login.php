<?php
require_once('db.php');

try {

	
	$stmt = $db->prepare("SELECT * FROM users WHERE (Email LIKE :email AND P4WD LIKE :pass)");
	$stmt->bindParam(':email', $Email);
	$stmt->bindParam(':pass', $Password);

	$Email = $_POST["email"];
	$Password = $_POST["password"];

	$stmt->execute();
	
	
	// start the session, set the session variable for User
	// then redirect back to index.php
	session_start();

	$_SESSION["User"] = $Email;

	//redirect user back to homepage
	header('Location: index.php?loggedIn=true');
}
catch (PDOException $e) {
	
	die('Sign In Failed! ');
}


?>