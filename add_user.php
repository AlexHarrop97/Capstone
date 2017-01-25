<?php
require_once('db.php');

try {
	
	
	$stmt = $db->prepare("INSERT INTO users (Email, P4WD, FirstName, LastName, AccessLevel) VALUES (:email, :pass, :fname, :lname, :accesslvl)");
	$stmt->bindParam(':email', $Email);
	$stmt->bindParam(':pass', $Password);
	$stmt->bindParam(':fname', $FirstName);
	$stmt->bindParam(':lname', $LastName);
	$stmt->bindParam(':accesslvl', $AccessLevel);
	
	$Email = $_POST["userName"];
	$Password = $_POST["password"];
	$FirstName = $_POST["firstName"];
	$LastName = $_POST["lastName"];
	
	// 0=User AccessLevel       
	// 1=Admin AccessLevel
	// This line sets the default access level
	$AccessLevel = '0';
	
	if ($_POST["password"] != $_POST["passConfirm"]) {

		echo "The passwords do not match! ";
	}
	else {

		$stmt->execute();
	}
	
	
	echo "Successfully Registered!";
	
	//redirect user back to homepage
	header('Location: index.php');
}
catch (PDOException $e) {
	
	die('Connection Failed! ');
}
?>