<?php

require_once('../dependencies/db.php');

$dateAndTime = date("m/d/Y H:i:s");
$tempProjectID = 0;

try { 

	$getUser = $db->prepare('SELECT User_ID FROM users WHERE (Email = :email)');
	$getUser->bindParam(':email', $_SESSION["User"]);
	$getUser->execute();
	$users = $getUser->fetchAll();

	foreach ($users as $user) {

		$userId = $user["User_ID"];
	}

	echo $userId;

	$sendComment = $db->prepare('INSERT INTO comments (User_ID, Message_Text, Message_Time, Project_ID) VALUES (:uID, :mText, :mTime, :pID)');
	$sendComment->bindParam(':uID', $userId);
	$sendComment->bindParam(':mText', $_POST["msgBox"]);
	$sendComment->bindParam(':mTime', $dateAndTime);
	$sendComment->bindParam(':pID', $tempProjectID);
	//$sendComment->execute();

	header('Location: ../comments.php');

}
catch (PDOException $e) { 

	die('WARNING: ' . $e->getMessage());
}


?>