<?php
require_once('../db.php');

session_start();


try {

	$stmt = $db->prepare('SELECT * FROM users');
	$stmt->execute();
	$users = $stmt->fetchAll();

	foreach ($users as $user) {

		while ($_SESSION["User"] == $user["Email"]) {
			
			$userEmail = $user["Email"];
			$userPass = $user["P4WD"];
			$userFirstName = $user["FirstName"];
			$userLastName = $user["LastName"];

		}
	}
}
catch (PDOException $e) {

	echo "Connection Failed " . $e->getMessage();
}






?>