
<?php
session_start();

require_once('../dependencies/db.php');

$dateAndTime = date("m/d/Y H:i:s");
$tempProjectID = 0;

try {
	
	$sendComment = $db->prepare('INSERT INTO comments (User_ID, Message_Text, Message_Time, Project_ID) VALUES (:uID, :mText, :mTime, :pID)');
	$sendComment->bindParam(':uID', $_SESSION["User_ID"]);
	$sendComment->bindParam(':mText', $_POST["msgBox"]);
	$sendComment->bindParam(':mTime', $dateAndTime);
	$sendComment->bindParam(':pID', $tempProjectID);
	$sendComment->execute();

	//header('Location: ../comments.php');

}
catch (PDOException $e) { 

	die('WARNING: ' . $e->getMessage());
}
