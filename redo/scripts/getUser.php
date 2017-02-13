<?php
require_once('../db.php');

session_start();


try {

	$Email = $_POST["userName"];
	$Password = $_POST["password"];

	$stmt = $db->prepare('SELECT * FROM users WHERE Email=:email');
	$stmt->bindParam(':email', $Email);
	$row = mysql_fetch_array($stmt);
	$stmt->execute();
	
	while ($row == $stmt->fetch(PDO::FETCH_ASSOC)) {
		if (password_verify ($Password, $row['password'])){
			echo "IN";
			//$_SESSION['userName'] = $Email;
			//header("Location: login.php?Email=".$Email);
		} else {
			echo "ERROR WRONG PASS";
		}
	}
} catch (PDOException $e) {
	die ("Connection Unsuccessful");
}





?>